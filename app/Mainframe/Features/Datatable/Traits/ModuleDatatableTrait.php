<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpMultipleClassDeclarationsInspection */

/** @noinspection UnknownColumnInspection */

namespace App\Mainframe\Features\Datatable\Traits;

use App\Mainframe\Features\Datatable\ModuleDatatable;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Features\Modular\BaseModule\MfModuleInterface;
use App\Module;
use Illuminate\Database\Query\Builder;
use URL;
use Yajra\DataTables\DataTableAbstract;

/** @mixin ModuleDatatable */
trait ModuleDatatableTrait
{
    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/
    /**
     * @return \App\Project\Features\Modular\BaseModule\BaseModule|\Illuminate\Database\Eloquent\Builder
     */
    public function source()
    {
        return $this->model->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by');
    }

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    /**
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
            [$this->table.'.id', 'actions', '-'],
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Builder|mixed|void
     */
    public function filter($query)
    {
        $query = $this->applyAutoFilterUsingRequestParameters($query);

        /**
         * Date range filter
         */
        if ($val = request('created_at_from')) { // From date range picker
            $query->where($this->table.'.created_at', '>=', date_create($val)->format('Y-m-d 00:00:00'));
        }

        if ($val = request('created_at_till')) { // From date range picker
            $query->where($this->table.'.created_at', '<=', date_create($val)->format('Y-m-d 23:59:59'));
        }

        if ($val = request('updated_at_from')) { // From date range picker
            $query->where($this->table.'.updated_at', '>=', date_create($val)->format('Y-m-d 00:00:00'));
        }

        if ($val = request('updated_at_till')) { // From date range picker
            $query->where($this->table.'.updated_at', '<=', date_create($val)->format('Y-m-d 23:59:59'));
        }

        return $query;
    }

    /**
     * Modify datatable row values
     *
     * @return DataTableAbstract
     */
    public function modify($dt)
    {
        if ($this->hasColumn('id')) {
            $dt->editColumn('id', function ($row) {
                return '<a href="'.route($this->module->name.'.edit', $row->id).'">'.$row->id.'</a>';
            });
        }

        if ($this->hasColumn('name')) {
            // $dt = $dt->editColumn('name', '<a href="{{ route(\''.$this->module->name.'.edit\', $id) }}">{{$name}}</a>');
            $dt->editColumn('name', function ($row) {
                return '<a href="'.route($this->module->name.'.edit', $row->id).'">'.$row->name.'</a>';
            });
        }

        if ($this->hasColumn('title')) {
            // $dt = $dt->editColumn('name', '<a href="{{ route(\''.$this->module->name.'.edit\', $id) }}">{{$name}}</a>');
            $dt->editColumn('title', function ($row) {
                return '<a href="'.route($this->module->name.'.edit', $row->id).'">'.$row->title.'</a>';
            });
        }

        if ($this->hasColumn('updated_by')) {
            $dt->editColumn('updated_by', function ($row) {
                return $row->updater->name ?? $row->updated_by;
            });
        }

        if ($this->hasColumn('actions')) {
            $dt->editColumn('actions', function ($row) {
                return $this->actionBtnHtml($row);
            });
        }

        return $dt;
    }

    /**
     * Define Query for generating results for grid
     *
     * @return Builder|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query()
    {
        $query = $this->source()->select($this->selects());

        // Note: If you are not using a model-based query you need to manually inject tenant context.

        // if (user()->ofTenant() && $this->module->tenantEnabled()) {
        //     $query->where($this->module->tableName().'.tenant_id', user()->tenant_id);
        // }

        // Exclude deleted rows
        $query->whereNull($this->table.'.deleted_at');

        return $this->filter($query);
    }

    /**
     * AJAX Call URL
     *
     * @return string
     */
    public function ajaxUrl()
    {
        // Important! Check if a URL is already assigned
        if (! $this->ajaxUrl) {
            $this->ajaxUrl = route($this->module->name.'.datatable-json');
        }

        // Pass the current request params to datatable from the current URL of the page
        if ($this->mergeRequest) {
            $this->ajaxUrl = urlWithParams($this->ajaxUrl, parse_url(URL::full(), PHP_URL_QUERY));
        }

        return $this->ajaxUrl;
    }

    /**
     * @param  Module|string  $module
     * @return ModuleDatatableTrait|bool
     */
    public function setModule($module)
    {
        if ($module) {
            return parent::setModule($module);
        }

        if (isset($this->moduleName)) {
            $module = Module::byName($this->moduleName);
        }

        if (! $module) {
            return false;
        }

        return parent::setModule($module);
    }

    /**
     * Automatically make the is_active field as boolean
     *
     * @return array|string[]
     */
    public function booleans()
    {
        return array_merge($this->booleans, ['is_active']);
    }

    /**
     * Get all the date fields defined in the model and set them as datetime
     *
     * @return array
     */
    public function datetimes()
    {
        /** @var BaseModule $this */
        $model = $this->module->modelInstance();

        return array_merge($this->datetimes, $model->getDates());
    }

    /**
     * Create the HTML for the 'actions' column
     *
     * @param  MfModuleInterface|mixed  $row
     */
    public function actionBtnHtml(mixed $row): string
    {
        $html = "<div class='dt-action-buttons'>";
        $html .= $this->viewBtnHtml($row);
        $html .= $this->deleteBtnHtml($row);
        $html .= '</div>';

        return $html;
    }

    /**
     * Create the HTML for the 'view' button
     *
     * @param  MfModuleInterface|mixed  $row
     */
    public function viewBtnHtml(mixed $row): string
    {
        return "<a class='btn btn-xs btn-inline' title='View' href='".$row->editUrl()."'><i class='fi fi-rr-eye'/></i></a>";
    }

    /**
     * Create the HTML for the 'delete' button
     *
     * @param  MfModuleInterface|mixed  $row
     */
    public function deleteBtnHtml(mixed $row): string
    {
        $html = '';
        $html .= view('form.delete-button', [
            'var' => [
                'route' => route($this->moduleName.'.destroy', $row->id),
                'redirect_success' => '#', // Stops redirect after deletion
                'name' => 'ListItemDeleteBtn-'.$this->moduleName,
                'class' => 'btn btn-xs pull-right', // btn-borderless-red
                'value' => '<i class="fa fa-trash"></i>',
                'params' => [
                    'title' => 'Delete',
                    'onclick' => 'showDeleteModalForBtn($(this))',
                    'data-refresh_datatable_id' => $this->id(),
                    // Enable datatable refresh on delete. Stop redirection.
                ],
            ],
        ]);
        $html .= '</div>';

        return $html;
    }
}
