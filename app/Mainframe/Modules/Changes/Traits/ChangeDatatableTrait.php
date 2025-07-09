<?php

namespace App\Mainframe\Modules\Changes\Traits;

use DB;

/** @mixin \App\Mainframe\Modules\Changes\ChangeDatatable */
trait ChangeDatatableTrait
{
    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/

    /**
     * Define Query Source
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function source()
    {
        return DB::table($this->table)->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by');
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
            [$this->table.'.field', 'field', 'Field'],
            [$this->table.'.old', 'old', 'Old'],
            [$this->table.'.new', 'new', 'New'],
            ['updater.name', 'user_name', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
        ];
    }

    /*---------------------------------
    | Section: SQL Select query
    |---------------------------------*/
    /**
     * Construct SELECT statement (field1 AS f1, field2 as f2...)
     *
     * @return array
     */
    public function selects()
    {
        $columns = array_merge($this->columns(), [
            [$this->table.'.id', 'id'],
        ]);

        return $this->selectQueryString($columns);
    }

    /*---------------------------------
    | Section: Filters
    |---------------------------------*/
    // /**
    //  * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
    //  */
    // public function filter($query)
    // {
    //     $query = parent::filter($query);
    //     // if (request('id')) { // Example code
    //     //     $query->where('id', request('id'));
    //     // }
    //
    //     return $query;
    // }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/
    /**
     * @param  \Yajra\DataTables\DataTableAbstract  $dt
     * @return mixed|\Yajra\DataTables\DataTableAbstract
     */
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
