<?php

namespace App\Project\Modules\Modules;

class ModuleDatatable extends \App\Mainframe\Modules\Modules\ModuleDatatable
{

    public $moduleName = 'modules';

    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/

    // /**
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
    //  */
    // public function source() { return parent::source(); }

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    // /**
    //  * @return array
    //  */
    // public function columns() { return parent::columns(); }

    /*---------------------------------
    | Section: SQL Select query
    |---------------------------------*/

    // /**
    //  * Construct SELECT statement (field1 AS f1, field2 as f2...)
    //  *
    //  * @return array
    //  */
    // public function selects() { return parent::selects(); }

    /*---------------------------------
    | Section: Filters
    |---------------------------------*/

    // /**
    //  * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
    //  */
    // public function filter($query) { return parent::filter($query); }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/

    // /**
    //  * @param  \Yajra\DataTables\DataTableAbstract  $dt
    //  * @return mixed|\Yajra\DataTables\DataTableAbstract
    //  */
    // public function modify($dt) { return parent::modify($dt); }

    /*---------------------------------
    | Section : Additional methods
    |---------------------------------*/
    // public function query()
    // public function json()
    // public function hasColumn()
    // public function titles()
    // public function columnsJson()
    // public function ajaxUrl()
    // public function identifier()
}
