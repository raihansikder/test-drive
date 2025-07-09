<?php
/** @noinspection PhpUnnecessaryLocalVariableInspection */

/** @noinspection UnknownColumnInspection */

namespace App\Mainframe\Features\Datatable\Traits;

use DB;
use Str;
use URL;
use Arr;
use App\Mainframe\Helpers\Mf;
use App\Mainframe\Features\Datatable\Datatable;

/** @mixin Datatable */
trait DatatableTrait
{
    /**
     * Define Query for generating results for grid
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function source()
    {
        return DB::table($this->table)
            ->leftJoin('users as updater', 'updater.id', '=', $this->table.'.updated_by');
    }

    /**
     * Define grid SELECT statement and HTML column name.
     *
     * @return array
     */
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.name', 'name', 'Name'],
            ['updater.name', 'user_name', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }

    /**
     * Construct SELECT statement (field1 AS f1, field2 as f2...)
     *
     * @return array
     */
    public function selects()
    {
        $columns = $this->columns();

        // Note: Modify the $columns as you need.

        return $this->selectQueryString($columns);
    }

    /**
     * Creates a SQL query string
     *
     * @param $columns
     * @return array
     */
    public function selectQueryString($columns)
    {
        $selects = [];
        foreach ($columns as $col) {
            $str = $col[0];
            if (isset($col[1])) {
                $str .= ' AS '.$col[1];
            }
            $selects[] = $str; // user.name as name
        }

        return $selects;
    }

    /**
     * Define Query for generating results for grid
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        $query = $this->source()->select($this->selects());

        // Exclude deleted rows
        $query = $query->whereNull($this->table.'.deleted_at');

        return $this->filter($query);
    }

    /**
     * Apply query filter
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function filter($query)
    {
        /** @noinspection PhpUnnecessaryLocalVariableInspection */
        $query = $this->applyAutoFilterUsingRequestParameters($query); // Auto-apply filter based on URL query param

        // Additionally, apply filter based on request parameters

        return $query;
    }

    /**
     * Auto-apply filter based on the request query
     *
     * @param $query \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function applyAutoFilterUsingRequestParameters($query)
    {
        $skipAutoFilterColumns = $this->getSkipAutoFilterColumns();

        $table = null;

        if ($this->table) {
            $table = $this->table;
        } elseif ($this->model) {
            $table = $this->model->getTable();
        }

        $columns = [];
        if ($table) {
            $columns = Mf::tableColumns($table);
        }

        foreach ($columns as $column) {
            if (in_array($column, $skipAutoFilterColumns)) {
                continue; // Skip
            }

            $val = null;
            if (request()->has($column)) {
                $val = request($column);
            }

            if (!is_array($val) && $val == '') {
                continue;
            }

            if (is_array($val)) { // Handle array input: param[]=1&param[]=2
                if (count(array_filter($val))) {
                    $query->whereIn($table.'.'.$column, array_filter($val));
                }
            } elseif (Str::startsWith($val, '[') && Str::endsWith($val, ']')) {
                // Handle string array representation: param=[1,2,3]
                $val = array_map(null, explode(',', trim($val, '[],')));
                $query->whereIn($table.'.'.$column, $val);
            } elseif (isCsv($val)) { // Handle CSV: param=1,2,3
                $query->whereIn($table.'.'.$column, csvToArray($val));
            } elseif ($val !== 'null') {
                $query->where($table.'.'.$column, $val);
            } else {
                $query->whereNull($table.'.'.$column);
            }
        }

        return $query;
    }

    /**
     * Get the columns for which auto filters should be skipped
     *
     * @return string[]
     */
    public function getSkipAutoFilterColumns()
    {
        return $this->skipAutoFilterColumns ?? ['order'];
    }

    /**
     * Get datatable default search input value
     *
     * @param  string  $key
     * @return mixed|null
     */
    public function searchValue(string $key = 'value')
    {
        if (!$search = request('search')) {
            return null;
        }

        return $search[$key] ?? null;
    }

    /**
     * Modify datatable values
     *
     * @return \Yajra\DataTables\DataTableAbstract
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function modify($dt)
    {
        // Handle binary columns

        // if ($this->hasColumn('name')) {
        //     // $dt = $dt->editColumn('name', '<a href="{{ route(\''.$this->module->name.'.edit\', $id) }}">{{$name}}</a>');
        //     $dt = $dt->editColumn('name', function ($row) {
        //         return '<a href="'.route($this->module->name.'.edit', $row->id).'">'.$row->name.'</a>';
        //     });
        // }

        return $dt;
    }

    /**
     * Transform values based on the transform array
     *
     * @return \Yajra\DataTables\DataTableAbstract
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function transformValues($dt)
    {
        $transforms = Arr::wrap($this->transforms());

        foreach ($transforms as $field => $value) {
            if ($this->hasColumn($field)) {
                $dt->editColumn($field, function ($row) use ($field, $value) {
                    return $value[(string) $row->$field] ?? $row->$field;
                });
            }
        }

        return $dt;
    }

    /**
     * Transform boolean field values. Show Yes/No instead of 1/0
     *
     * @return \Yajra\DataTables\DataTableAbstract
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function transformBooleans($dt)
    {
        $booleans = Arr::wrap($this->booleans());

        foreach ($booleans as $field) {
            if ($this->hasColumn($field)) {
                $dt->editColumn($field, function ($row) use ($field) {
                    if ($row->$field == 1) {
                        return 'Yes';
                    }
                    if ($row->$field == 0) {
                        return '<span class="text-red">No</span>';
                    }
                    return $row->$field;
                });
            }
        }

        return $dt;
    }

    /**
     * Transform datetime field values
     *
     * @return \Yajra\DataTables\DataTableAbstract
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function transformDatetimes($dt)
    {
        $datetimes = Arr::wrap($this->datetimes());

        foreach ($datetimes as $field) {
            if ($this->hasColumn($field)) {
                $dt->editColumn($field, function ($row) use ($field) {
                    if ($row->$field) {
                        return formatDateTime($row->$field);
                    }

                    return $row->$field;
                });
            }
        }

        return $dt;
    }

    /**
     * Transform date field values using formatDate function
     *
     * @return \Yajra\DataTables\DataTableAbstract
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function transformDates($dt)
    {
        $dates = Arr::wrap($this->dates());

        foreach ($dates as $field) {
            if ($this->hasColumn($field)) {
                $dt->editColumn($field, function ($row) use ($field) {
                    if ($row->$field) {
                        return formatDate($row->$field);
                    }

                    return $row->$field;
                });
            }
        }

        return $dt;
    }

    /**
     * Initiate the datatable
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function process()
    {
        $this->initDatatable();
        $dt = $this->dt;

        if (count($this->whiteList)) {
            $dt->whitelist($this->whiteList);
        }

        if (count($this->blackList)) {
            $dt->blacklist($this->blackList);
        }

        $dt->rawColumns(array_merge($this->rawColumns, $this->columnKeys()));

        $dt = $this->transformBooleans($dt);
        $dt = $this->transformDateTimes($dt);
        $dt = $this->transformDates($dt);
        $dt = $this->transformValues($dt);

        return $dt;
    }

    /**
     * Returns datatable JSON for the module index page
     * A route is automatically created for all modules to access this controller function
     *
     * @return \Illuminate\Http\JsonResponse
     * @var \Yajra\DataTables\DataTables $dt
     */
    public function json()
    {
        $dt = $this->process();

        return $this->modify($dt)->toJson();
    }

    /**
     * Instantiate data table.
     *
     * @return $this
     */
    public function initDatatable()
    {
        $query = $this->query();

        // Set a default limit if not set in the request
        if (!request('length')) {
            $query->limit(10);
        }

        $this->dt = datatables($query);

        return $this;
    }

    /**
     * Check if a column exists in the data table
     *
     * @param $column
     * @return bool
     */
    public function hasColumn($column)
    {
        foreach ($this->columns() as $col) {
            if ($col[1] == $column) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get only the visible columns
     *
     * @return array
     */
    public function visibleColumns()
    {
        return collect($this->columns())->reject(function ($item) {
            return in_array($item[1], $this->hidden());
        })->all();
    }

    /**
     * Titles extracted from the column definition
     *
     * @return array
     * @noinspection PhpUnusedParameterInspection
     */
    public function titles()
    {
        $titles = $this->visibleColumns();

        return collect($titles)->map(function ($item, $key) {
            return $item[2]; // Take 3rd index
        })->all();
    }

    public function columnKeys()
    {
        $columns = $this->visibleColumns();

        return collect($columns)->map(function ($item) {
            return $item[1]; // Take 2nd
        })->all();
    }

    /**
     * Json value for Javascript dataTable.ajax
     * { data: 'id', name: 'settings.id' },{ data: 'name', name: 'settings.name' },...
     *
     * @return mixed
     */
    public function columnsJson()
    {
        return collect($this->columns())
            // The reduce method reduces the collection to a single value, passing the result of
            // each iteration into the subsequent iteration:
            ->reduce(function ($carry, $item) {
                if (!in_array($item[1], $this->hidden())) {
                    return $carry."{ data: '".$item[1]."', name: '".$item[0]."' },";
                }

                return $carry;
            });
    }

    /**
     * API url
     *
     * @return string
     */
    public function ajaxUrl()
    {
        // If mergeRequest is true, then merge the current request params to the ajax url
        if ($this->mergeRequest) {
            return urlWithParams($this->ajaxUrl, parse_url(URL::full(), PHP_URL_QUERY));
        }

        return $this->ajaxUrl;
    }


}
