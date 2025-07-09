<?php

namespace App\Mainframe\Modules\Contents\Traits;

use App\Content;

/** @mixin \App\Mainframe\Modules\Contents\ContentDatatable */
trait ContentDatatableTrait
{
    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function source()
    {
        return Content::with(['updater:id,name',]); // Model based query.
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
            [$this->table.'.name', 'name', 'name'],
            [$this->table.'.key', 'key', 'key'],
            [$this->table.'.updated_by', 'updated_by', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }

    // /**
    //  * Note: Apply filter on query.
    //  *
    //  * @param $query \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
    //  * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
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

    /**
     * Note: Modify datatable values
     *
     * @return mixed
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    // public function modify($dt)
    // {
    //     $dt = parent::modify($dt);
    //
    //     if ($this->hasColumn('column_name')) {
    //         $dt->editColumn('column_name', function ($row) {
    //             return $row->column_name.'updated';
    //         });
    //     }
    //
    //     return $dt;
    // }

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
