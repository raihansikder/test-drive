<?php

namespace App\Mainframe\Modules\Assignments\Traits;

use App\Assignment;

/** @mixin \App\Mainframe\Modules\Assignments\AssignmentDatatable */
trait AssignmentDatatableTrait
{
    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function source()
    {
        return Assignment::with(['updater:id,name', 'relatedModule:id,name,title', 'assignee:id,name', 'assignable']); // Model based query.
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
            [$this->table.'.assignee_user_id', 'assignee_user_id', 'Assignee'],
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
    /**
     * Construct SELECT statement (field1 AS f1, field2 as f2...)
     *
     * @return array
     */
    public function selects()
    {
        $columns = array_merge($this->columns(), [
            [$this->table.'.id', 'id'],
            [$this->table.'.assignable_id', 'assignable_id'],
            [$this->table.'.assignable_type', 'assignable_type'],
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
    public function modify($dt)
    {
        $dt = parent::modify($dt);

        if ($this->hasColumn('module_id')) {
            $dt->editColumn('module_id', function ($row) {
                /** @var \App\Assignment $row */
                return optional($row->relatedModule)->name;
            });
        }
        if ($this->hasColumn('assignee_user_id')) {
            $dt->editColumn('assignee_user_id', function ($row) {
                /** @var \App\Assignment $row */
                return optional($row->assignee)->name;
            });
        }

        if ($this->hasColumn('element_id')) {
            $dt->editColumn('element_id', function ($row) {
                /** @var \App\Assignment $row */
                return optional($row->assignable)->editLink();
            });
        }

        return $dt;
    }

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
