<?php

namespace App\Project\Datatables;

use App\Comment;
use App\Project\Modules\Comments\CommentDatatable;
use App\Mainframe\Features\Datatable\Traits\CustomDatatableTrait;
use App\Mainframe\Modules\Comments\Traits\CommentWidgetDatatableTrait;

class CommentWidgetDatatable extends CommentDatatable
{

    use CustomDatatableTrait, CommentWidgetDatatableTrait;

    /**
     * @param $module
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*---------------------------------
    | Section : Define query tables/model\
    |---------------------------------*/
    // /**
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function source()
    // {
    //     return Comment::with(['creator:id,name,email']); // Model based query.
    // }

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    // /**
    //  * @return array
    //  */
    // public function columns()
    // {
    //     return [
    //         [$this->table.'.id', 'id', 'ID'],
    //         [$this->table.'.created_at', 'created_at', "<span style='width:80px; float:left'>From</span>"],
    //         [$this->table.'.name', 'name', 'Name'],
    //         [$this->table.'.body', 'body', "<span style='width:280px; float:left'>Message</span>"],
    //         [$this->table.'.created_by', 'created_by', 'Created By'],
    //         // [$this->table.'.is_active', 'is_active', 'Active'],
    //     ];
    // }

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
    //
    //     if ($this->hasColumn('created_at')) {
    //         $dt->editColumn('created_at', function ($row) {
    //             return "<span class='text-bold'>".optional($row->creator)->name.'</span><br/> '
    //                 ."<span class='text-sm'>".formatDateTime($row->created_at).'</span>';
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
