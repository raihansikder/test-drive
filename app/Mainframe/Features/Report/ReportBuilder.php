<?php

namespace App\Mainframe\Features\Report;

use Illuminate\Database\Query\Builder;
use App\Mainframe\Features\Report\Traits\Query;
use App\Mainframe\Features\Report\Traits\Output;
use App\Mainframe\Features\Report\Traits\Columns;
use App\Mainframe\Http\Controllers\BaseController;
use App\Mainframe\Features\Report\Traits\Filterable;

class ReportBuilder extends BaseController
{
    use Filterable, Columns, Query, Output;

    /** @var  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Model DB Table/View names */
    public $dataSource;

    /** @var string */
    public $table;

    /** @var  string Directory location of the report blade templates */
    public $path = 'mainframe.layouts.report';

    /** @var int Cache time */
    public $cache = 1;

    /** @var  Builder */
    public $query;

    /** @var  \Illuminate\Support\Collection */
    public $result;

    /** @var integer */
    public $total;

    /** @var integer Default rows per page */
    public $rowsPerPage;

    /** @var array sting search with %*** % */
    public $fullTextFields = ['name', 'name_ext'];

    /** @var array Fields to search */
    public $searchFields = ['name', 'name_ext'];

    /** @var string */
    public $downloadFileName;

    /** @var string */
    public $filterPath;

    /** @var string */
    public $initFunctionsPath;

    /** @var \App\Module */
    public $module;

    /** @var \App\Mainframe\Features\Modular\BaseModule\BaseModule */
    public $model;

    /** @var \App\User */
    public $user;

    /**
     * ReportBuilder constructor.
     *
     * @param  string  $dataSource
     * @param  string  $path
     * @param  int  $cache
     */
    public function __construct($dataSource = null, $path = null, $cache = null)
    {
        parent::__construct();

        $this->transformRequest();
        $this->setDataSource($dataSource);
        $this->path = $path ?: $this->path;
        $this->cache = $cache ?: $this->cache;
    }

    // public function queryDataSource() { }
    // public function defaultFilterEscapeFields() { }
    // public function customFilterOnEscapedFields($query, $field, $val) { }
    // public function columnOptions() { }
    // public function ghostColumnOptions() { }®
    // public function defaultColumns() { }

    /*
    |--------------------------------------------------------------------------
    | Group by Configurations
    |--------------------------------------------------------------------------
    */
    // public function queryAddColumnForGroupBy($keys = []) { }
    // public function additionalSelectedColumnsDueToGroupBy() { }
    // public function additionalAliasColumnsDueToGroupBy() { }

}
