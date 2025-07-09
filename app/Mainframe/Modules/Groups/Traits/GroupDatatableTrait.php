<?php

namespace App\Mainframe\Modules\Groups\Traits;

use App\Mainframe\Helpers\Date;

trait GroupDatatableTrait
{
    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/

    // /**
    //  * @return \Illuminate\Database\Query\Builder|static
    //  */
    // public function source()
    // {
    //     return DB::table($this->table)->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by');
    // }

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
            [$this->table.'.title', 'title', 'Title'],
            [$this->table.'.name', 'name', 'System Name'],
            ['updater.name', 'user_name', 'Updater'],
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
    //     $columns = array_merge($this->columns(), [
    //         [$this->table.'.id', 'id'],
    //     ]);
    //
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
     * Modify datatable values
     *
     * @return mixed
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function modify($dt)
    {

        if ($this->hasColumn('name')) {
            // $dt = $dt->editColumn('name', '<a href="{{ route(\''.$this->module->name.'.edit\', $id) }}">{{$name}}</a>');
            $dt = $dt->editColumn('name', function ($row) {
                return '<code>'.$row->name.'</code>';
            });
        }
        if ($this->hasColumn('id')) {
            $dt = $dt->editColumn('id', '<a href="{{ route(\''.$this->module->name.'.edit\', $id) }}">{{$id}}</a>');
        }

        if ($this->hasColumn('is_active')) {
            $dt = $dt->editColumn('is_active', '@if($is_active)  Yes @else <span class="text-red">No</span> @endif');
        }

        if ($this->hasColumn('updated_at')) {
            $dt = $dt->editColumn('updated_at', function ($row) {
                return Date::formattedDateTime($row->updated_at);
            });
        }

        if ($this->hasColumn('title')) {
            $dt = $dt->editColumn('title', function ($row) {
                return '<a href="'.route($this->module->name.'.edit', $row->id).'">'.$row->title.'</a>';
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
