<?php

namespace App\Mainframe\Features\Report\Traits;

use Str;
use URL;
use DateTime;
use Debugbar;
use App\Report;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Mainframe\Helpers\Convert;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use App\Mainframe\Features\Report\ReportBuilder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Mainframe\Features\Report\ReportViewProcessor;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/** @mixin ReportBuilder $this */
trait Output
{
    /**
     * Generate report output
     *
     * @return Factory|\Illuminate\Http\JsonResponse|null|string|View
     * @throws \Exception
     */
    public function output()
    {
        if (!$this->isValid()) {
            return $this->responseInvalid();
        }

        if ($this->outputType() == 'json') {
            return $this->json();
        }

        if ($this->outputType() == 'excel') {
            return $this->excel();
        }

        if ($this->outputType() == 'csv') {
            return $this->csv();
        }

        if ($this->outputType() == 'print') {
            return $this->html('print');
        }

        // Show the result in the report default view. Merge the selected columns and aliases in the request so that
        // the input fields are pre-filled with the selected columns and aliases.
        request()->merge([
            'columns_csv' => Convert::arrayToCsv($this->selectedColumns()),
            'alias_columns_csv' => Convert::arrayToCsv($this->aliasColumns()),
        ]);

        if (request('submit') != 'Run') {
            return $this->html('blank');
        }

        return $this->html();
    }

    /**
     * Enable report auto-run. Run even if no submit=Run in URL
     *
     * @return $this
     */
    public function enableAutoRun()
    {
        request()->merge(['submit' => 'Run']);

        return $this;
    }

    /**
     * Invalid request
     *
     * @return Factory|\Illuminate\Http\JsonResponse|View
     */
    public function responseInvalid()
    {
        $this->fail();
        $this->response()->validator = $this->validator;

        if ($this->outputType() != 'json') {
            return $this->html('blank');
        }

        return $this->json();
    }

    /**
     * Resolve the view path to be used for the result view
     *
     * @return string
     */
    public function resultViewPath()
    {
        if (isset($this->resultViewPath)) {
            return $this->resultViewPath;
        }

        $paths = [
            $this->path.'.result',
            projectResources().'.layouts.report.result',
        ];

        foreach ($paths as $path) {
            if (view()->exists($path)) {
                return $path;
            }
        }

        return 'mainframe.layouts.report.result';
    }

    /**
     * Get result view path.
     *
     * @return string
     */
    public function resultPrintPath()
    {
        if (isset($this->resultViewPath)) {
            return $this->resultViewPath;
        }

        $paths = [
            $this->path.'.result-print',
            projectResources().'.layouts.report.result-print',
        ];

        foreach ($paths as $path) {
            if (view()->exists($path)) {
                return $path;
            }
        }

        return 'mainframe.layouts.report.result-print';
    }

    /**
     * Define Json payload for report. Load all the items under $result['items']
     *
     * @param  string|null  $resource  Define a ResourceCollection
     * @return array
     * @throws \Exception
     */
    public function jsonPayload($resource = null)
    {
        $mutatedResults = $this->mutateResult();

        if ($resource) {
            /** @var ResourceCollection $resourceCollection */
            $resourceCollection = (new $resource($mutatedResults));
            $items = $resourceCollection->collection->toArray();
        }

        /** @var Collection $mutatedResults */
        $result = !is_array($mutatedResults) ? $mutatedResults->toArray() : $mutatedResults;

        $result['items'] = $items ?? $result['data'] ?? [];

        unset($result['data']); // After loading the items in $result['items'] unset $result['data]

        return $result;
    }

    /**
     * Output JSON
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function json($resource = null)
    {
        return $this->success('Request Processed')
            ->load($this->jsonPayload($resource))
            ->json();
    }

    /**
     * Download excel
     *
     * @param  bool  $csv
     * @return null|string
     * @throws \Exception
     */
    public function excel($csv = false)
    {
        $selectedColumns = $this->mutateSelectedColumns();
        $aliasColumns = $this->mutateAliasColumns();
        $result = $this->mutateResult();

        try {
            /** @noinspection PhpVoidFunctionResultUsedInspection */
            return $this->dumpExcel($selectedColumns, $aliasColumns, $result, $csv);
        } catch (Exception|\PhpOffice\PhpSpreadsheet\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Download CSV
     *
     * @return null|string
     * @throws \Exception
     */
    public function csv()
    {
        return $this->excel($csv = true);
    }

    /**
     * Define the view variables to be passed to blade
     *
     * @throws \Exception
     */
    public function viewVars($type = null)
    {
        // dd($this->mutateResult()->toArray());
        $vars = [
            'path' => $this->path, // Older implementation
            'report' => $this,
            'columnOptions' => $this->columnOptions(),
            'view' => $this->viewProcessor(),
        ];

        // Report prior to running
        if ($type != 'blank') {
            $vars = array_merge($vars, [
                'selectedColumns' => $this->mutateSelectedColumns(),
                'aliasColumns' => $this->mutateAliasColumns(),
                'total' => $this->total(),
                'result' => $this->mutateResult(),
            ]);
        }

        return array_merge($vars, $this->customViewVars());
    }

    /**
     * Additional view variables to pass to view blade
     *
     * @return array
     */
    public function customViewVars()
    {
        // $var = ['variable'=>'value'];
        // return $var;

        return [];
    }

    /**
     * View blade path
     *
     * @param $type
     * @return string
     */
    public function viewPath($type)
    {
        if ($type == 'print') {
            return $this->resultPrintPath();
        }

        return $this->resultViewPath();
    }

    /**
     * Output as HTML
     *
     * @param  null  $type  blank|print|null
     * @return Factory|View
     * @throws \Exception
     */
    public function html($type = null)
    {
        $vars = $this->viewVars($type);
        $path = $this->viewPath($type);

        return $this->response()->view($path, $vars);
    }

    /**
     * Dump data into excel
     *
     * @param $selectedColumns
     * @param $aliasColumns
     * @param $result
     * @param  bool  $csv
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     */
    public function dumpExcel($selectedColumns, $aliasColumns, $result, $csv = false)
    {
        Debugbar::disable(); // Disable debugger. Because it add debug codes in output file.

        $ext = $csv ? '.csv' : '.xlsx';

        $spreadsheet = new Spreadsheet();

        /** @var Worksheet $sheet */
        $sheet = $spreadsheet->getActiveSheet();
        $ranges = $this->excelColumnRange(count($selectedColumns));

        /**
         * First column with title
         */
        $i = 0;
        foreach ($aliasColumns as $column) {
            $sheet->setCellValue($ranges[$i++]. 1, $column);
        }

        // Starting from A2
        $j = 2;

        foreach ($result as $row) {
            $k = 0;
            foreach ($selectedColumns as $column) {
                $val = $row->$column;
                if (is_array($val)) {
                    $val = json_encode($val);
                } elseif (is_object($val)) {
                    if (is_a($val, DateTime::class)) {
                        $val = formatDateTime($val);
                    } else {
                        $val = json_encode($val);
                    }
                }
                $sheet->setCellValue($ranges[$k++].$j, strip_tags($val));
            }
            $j++;
        }

        /** @noinspection DuplicatedCode */
        if ($csv) {
            $writer = new Csv($spreadsheet);
            $writer->setDelimiter(',');
            $writer->setEnclosure('');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
        } else {
            $writer = new Xlsx($spreadsheet);
        }

        $filename = ($this->downloadFileName ?? 'Report-').now().$ext;

        clean_output_buffer();

        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $writer->save('php://output');
    }

    /**
     * Create column range for Excel
     *
     * @param $no_of_columns
     * @return array // ['A','B', ... 'AA', 'ZZ']
     */
    public function excelColumnRange($no_of_columns)
    {
        $letters = range('A', 'Z');

        $range = [];
        for ($i = 0; $i < $no_of_columns; $i++) {
            $position = $i * 26;
            foreach ($letters as $ii => $letter) {
                $position++;
                if ($position <= $no_of_columns) {
                    $range[] = ($position > 26 ? $range[$i - 1] : '').$letter;
                }
            }
        }

        return $range;
    }

    /**
     * Output type
     *
     * @return mixed
     */
    public function outputType()
    {
        if ($this->expectsJson()) {
            return 'json';
        }

        return request('ret') ?? 'html';
    }

    /**
     * Function changes result, show_column, aliasColumns for the final output
     *
     * @return LengthAwarePaginator|Collection
     * @throws \Exception
     */
    public function mutateResult()
    {
        $result = $this->result();
        // foreach ($result as $row) {
        //     $row->is_active = randomString();
        // }

        return $result;
    }

    /**
     * Change value of a single field in a result row
     *
     * @param $row
     * @param $column
     * @param  null  $val
     */
    public function mutate($row, $column, $val = null)
    {
        if (!$this->selectedColumnsHas($column)) {
            return;
        }

        $row->$column = $val;
    }

    /**
     * @return ReportViewProcessor
     * @noinspection PhpUnnecessaryLocalVariableInspection
     */
    public function viewProcessor()
    {
        $view = new ReportViewProcessor($this);

        return $view;
    }

    /*---------------------------------
    | View/rendering related functions
    |---------------------------------*/

    /**
     * Path for filter blade
     *
     * @return string
     */
    public function filterPath()
    {
        if (isset($this->filterPath)) {
            return $this->filterPath;
        }

        $paths = [
            $this->path.'.filters',
            $this->path.'.includes.filters',
            projectResources().'.layouts.report.includes.filter',
        ];

        foreach ($paths as $path) {
            if (view()->exists($path)) {
                return $path;
            }
        }

        return 'mainframe.layouts.report.includes.filter';
    }

    /**
     * Path for functions blade
     *
     * @return string
     */
    public function initFunctionsPath()
    {
        if (isset($this->initFunctionsPath)) {
            return $this->initFunctionsPath;
        }

        $paths = [
            $this->path.'.init-functions',
            $this->path.'.includes.init-functions',
            projectResources().'.layouts.report.includes.init-functions',
        ];

        foreach ($paths as $path) {
            if (view()->exists($path)) {
                return $path;
            }
        }

        return 'mainframe.layouts.report.includes.init-functions';
    }

    /**
     * Path for functions blade
     *
     * @return string
     */
    public function ctaPath()
    {
        if (isset($this->ctaPath)) {
            return $this->ctaPath;
        }

        $paths = [
            $this->path.'.cta',
            $this->path.'.includes.cta',
            projectResources().'.layouts.report.includes.cta',
        ];

        foreach ($paths as $path) {
            if (view()->exists($path)) {
                return $path;
            }
        }

        return 'mainframe.layouts.report.includes.cta';
    }

    /**
     * Path for functions blade
     *
     * @return string
     */
    public function advancedFilterPath()
    {
        if (isset($this->ctaPath)) {
            return $this->ctaPath;
        }

        $paths = [
            $this->path.'.advanced',
            $this->path.'.includes.advanced',
            projectResources().'.layouts.report.includes.advanced',
        ];

        foreach ($paths as $path) {
            if (view()->exists($path)) {
                return $path;
            }
        }

        return 'mainframe.layouts.report.includes.advanced';
    }

    /**
     * Transforms the values of a cell. This is useful for creating links, changing colors etc.
     *
     * @param  string  $column
     * @param  Model|object|array  $row
     * @param  string  $value
     * @param  string|null  $moduleName
     * @return string|null
     * @deprecated use cell()
     */
    public function transformRow($column, $row, $value, $moduleName = null)
    {
        // linked to facility details page
        $newValue = $value;

        if (in_array($column, ['id', 'name'])) {
            if (isset($row->id) && $moduleName) {
                $newValue = "<a href='".route($moduleName.'.edit', $row->id)."'>".$value.'</a>';
            }
        }

        return $newValue;
    }

    /**
     * Extracts the 'column' name part form 'table.column'
     *
     * @param $column
     * @return string
     */
    public function extractColumn($column)
    {
        if (Str::contains($column, ' as ')) {
            return trim(Str::after($column, ' as '));
        }

        if (Str::contains($column, '.')) {
            return Str::after($column, '.');
        }

        return $column;
    }

    /**
     * Transforms the values of a cell. This is useful for creating links, changing colors etc.
     *
     * @param  string  $column
     * @param  Model|object|array  $row
     * @param  string  $route
     * @return string
     */
    public function cell($column, $row, $route = null)
    {
        // Try to wisely assume the column name
        $column = $this->extractColumn($column);

        // Temp $val to store the value. Check both object, array possibility
        // dd($row);
        $val = $row->$column ?? $row[$column];

        if (is_array($val)) {  // Value is array or object
            return json_encode($val);
        }

        // Add link for name, id fields if possible
        if ($val && $this->cellIsLinkable($column)) {
            return $this->linkCell($column, $row, $route);
        }
        /*---------------------------------
        | Additional logic
        |---------------------------------*/

        return $val;
    }

    /**
     * Check if the column is linkable
     *
     * @param $column
     * @return bool
     */
    public function cellIsLinkable($column)
    {
        return in_array($column, ['id', 'name']);
    }

    /**
     * Check if output type allows HTML link 'a' tag
     *
     * @return bool
     */
    public function outputIsLinkable()
    {
        return in_array($this->outputType(), ['html']);
    }

    /**
     * Apply Link to column
     *
     * @param $column
     * @param $row
     * @param $route
     * @return mixed|string
     */
    public function linkCell($column, $row, $route = null)
    {
        if (!$this->outputIsLinkable()) {
            return $row->$column;
        }

        if (!$route) {
            $route = $this->elementViewUrl($row);
        }

        // Add link
        if ($route) {
            return "<a href='{$route}'>".$row->$column.'</a>';
        }

        return $row->$column;
    }

    /**
     * Link to module element
     *
     * @param $row
     * @return string|null
     */
    public function elementViewUrl($row)
    {
        if (!$this->module) {
            return null;
        }

        if (!isset($row->id)) {
            return null;
        }

        return route($this->module->name.'.show', $row->id);
    }

    /**
     * Excel download URL
     *
     * @return string
     */
    public function excelDownloadUrl()
    {
        $requests = request()->all();
        $requests['ret'] = 'excel';

        return $this->buildUrl($requests);
    }

    /**
     * Report print URL
     *
     * @return string
     */
    public function printUrl()
    {
        $requests = request()->all();
        $requests['ret'] = 'print';

        return $this->buildUrl($requests);
    }

    /**
     * Report Json URL
     *
     * @return string
     */
    public function jsonUrl()
    {
        $requests = request()->all();
        $requests['ret'] = 'json';

        return $this->buildUrl($requests);
    }

    /**
     * Save report URL
     *
     * @return string
     */
    public function saveUrl()
    {
        $url = route('reports.create');
        $params = [
            'title' => request('report_name'),
            'name' => request('report_name'),
            'parameters' => urlencode(str_replace(route('home'), '', URL::full())),
        ];

        return $url.'?'.http_build_query($params);
    }

    /**
     * Show save button based on permission
     *
     * @return bool
     */
    public function showSaveReportBtn()
    {
        return $this->user->can('create', Report::class);
    }

    /**
     * Show column title with link
     *
     * @param $index
     * @return string
     */
    public function columnTitle($index)
    {
        $report = $this;
        $alias = $report->mutateAliasColumns()[$index] ?? 'NA';

        $column = $this->extractColumn($report->mutateSelectedColumns()[$index] ?? 'NA');

        if (!$this->columnIsSortable($column)) {
            return $alias;
        }

        $orderBy = request('order_by');
        $linkCss = '';

        if ($orderBy) {
            if (Str::startsWith($orderBy, $column.' ASC')) {
                $orderBy = str_replace($column.' ASC', $column.' DESC', $orderBy);
                $icon = $this->sortAscIcon();
                $linkCss = 'btn btn-xs bg-red sort-btn';
            } elseif (Str::startsWith($orderBy, $column.' DESC')) {
                $orderBy = str_replace($column.' DESC', $column.' ASC', $orderBy);
                $icon = $this->sortDescIcon();
                $linkCss = 'btn btn-xs bg-red sort-btn';
            } else {
                // $orderBy .= ','.$column.' DESC'; // For multiple sorting
                $orderBy = $column.' ASC';
                // $icon = $this->sortDefaultIcon();
                $icon = '';
            }
        } else {
            $orderBy = $column.' ASC';
            // $icon = $this->sortDefaultIcon();
            $icon = '';
        }

        $requests = request()->all(); // Note:creates large URLs
        $requests['order_by'] = $orderBy;
        $url = $this->buildUrl($requests);

        return " <a class='{$linkCss}' href='{$url}'>$alias {$icon}</a>";
    }

    /**
     * Columns that are sortable in report UI
     *
     * @return array
     */
    public function sortableColumns()
    {
        if (isset($this->sortableColumns)) {
            return $this->sortableColumns;
        }

        return $this->mutateSelectedColumns();
    }

    /**
     * Check if column is sortable
     *
     * @param $column
     * @return bool
     */
    public function columnIsSortable($column)
    {
        return in_array($column, $this->sortableColumns());
    }

    /**
     * Sort icon Asc
     *
     * @return string
     */
    public function sortAscIcon()
    {
        return "<i class='column-sort glyphicon glyphicon-sort-by-attributes'></i>";
    }

    /**
     * Sort icon Desc
     *
     * @return string
     */
    public function sortDescIcon()
    {
        return "<i class='column-sort glyphicon glyphicon-sort-by-attributes-alt'></i>";
    }

    /**
     * Default sort icon
     *
     * @return string
     */
    public function sortDefaultIcon()
    {
        return "<i class='column-sort glyphicon glyphicon-sort'></i>";
    }

    /**
     * Construct the full report url from request params
     *
     * @param  array  $params
     * @return string
     */
    public function buildUrl($params = [])
    {
        return URL::current().'?'.http_build_query($params);
    }

    /**
     * Check if the selected columns are valid
     *
     * @return Output
     */
    public function validateSelectedColumns()
    {
        $selectColumns = $this->selectedColumns();
        foreach ($selectColumns as $selectColumn) {
            if (!in_array($selectColumn, $this->columnOptions())) {
                $this->error($selectColumn.'- is not a valid field');
            }
        }

        return $this;
    }

}
