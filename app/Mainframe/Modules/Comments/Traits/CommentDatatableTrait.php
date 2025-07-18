<?php

namespace App\Mainframe\Modules\Comments\Traits;

use App\Comment;

trait CommentDatatableTrait
{
    /*---------------------------------
   | Section : Define query tables/model
   |---------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function source()
    {
        // return \DB::table($this->table)->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by'); // Old table based implementation
        return Comment::with(['updater:id,name']); // Model based query.
    }

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.name', 'name', 'name'],
            [$this->table.'.module_id', 'module_id', 'Module'],
            [$this->table.'.element_id', 'element_id', 'Module Related Entry'],
            [$this->table.'.updated_by', 'updated_by', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }

    /*---------------------------------
    | Section: SQL Select query
    |---------------------------------*/
    // /**
    //  * Construct SELECT statement (field1 AS f1, field2 as f2...)
    //  *
    //  * @return array
    //  */
    // public function selects()
    // {
    //     $columns = $this->columns();
    //     // Note: Modify the $columns as you need.
    //     return $this->selectQueryString($columns);
    // }

    /*---------------------------------
    | Section: Filters
    |---------------------------------*/
    // /**
    //  * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
    //  */
    // public function filter($query)
    // {
    //     // if (request('id')) { // Example code
    //     //     $query->where('id', request('id'));
    //     // }
    //
    //     return $query;
    // }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/
    // /**
    //  * @param  \Yajra\DataTables\DataTableAbstract  $dt
    //  * @return mixed|\Yajra\DataTables\DataTableAbstract
    //  */
    // public function modify($dt)
    // {
    //     $dt = parent::modify($dt);
    //     if ($this->hasColumn('updated_by')) {
    //         $dt->editColumn('updated_by', function ($row) { return optional($row->updater)->name; });
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
