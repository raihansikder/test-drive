<?php

namespace App\Mainframe\Modules\SystemEvents\Traits;

use App\SystemEvent;

/** @mixin \App\Mainframe\Modules\SystemEvents\SystemEventDatatable */
trait SystemEventDatatableTrait
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
        return SystemEvent::with(['updater:id,name', 'user:id,name', 'linkedModule:id,title']); // Model based query.
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
            [$this->table.'.provider', 'provider', 'Provider'],
            [$this->table.'.type', 'type', 'Type'],
            [$this->table.'.environment', 'environment', 'Environment'],
            [$this->table.'.source', 'source', 'Source'],
            [$this->table.'.user_id', 'user_id', 'User'],
            [$this->table.'.module_id', 'module_id', 'Module'],
            [$this->table.'.occurred_at', 'occurred_at', 'Occurred At'],
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
    //         [$this->table.'.id', 'id', 'id'],
    //     ]);
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
    public function filter($query)
    {
        $query = parent::filter($query); // Auto-apply filter for inputs that match table field name
        /*══════════════════════════════════════════════════════
        ░ Tag search query
        ══════════════════════════════════════════════════════*/
        if ($val = request('tags')) {
            $tags = explode(',', $val);
            $query->where(function ($q) use ($tags) {
                foreach ($tags as $tag) {
                    $q->orWhere('tags', 'LIKE', '%'.$tag.'%');
                }
            });
        }
        /*══════════════════════════════════════════════════════
        ░ Date range picker query
        ══════════════════════════════════════════════════════*/
        if ($val = request('occurred_at_from')) {
            $datetime = date_create($val)->format('Y-m-d 00:00:00'); // Beginning of day
            $query->where('occurred_at', '>=', $datetime);
        }
        if ($val = request('occurred_at_till')) {
            $datetime = date_create($val)->format('Y-m-d 23:59:59'); // End of day
            $query->where('occurred_at', '<=', $datetime);
        }

        return $query;
    }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/
    // /**
    //  * @param  \Yajra\DataTables\DataTableAbstract  $dt
    //  * @return mixed|\Yajra\DataTables\DataTableAbstract
    //  */
    public function modify($dt)
    {
        $dt = parent::modify($dt);

        if ($this->hasColumn('user_id')) {
            $dt = $dt->editColumn('user_id', function (SystemEvent $row) {
                if ($row->user) {
                    return '<a href="'.route('users.edit', $row->user_id).'">'.optional($row->user)->name.'</a>';
                }
            });
        }

        if ($this->hasColumn('module_id')) {
            $dt->editColumn('module_id', function (SystemEvent $row) {
                return optional($row->linkedModule)->title;
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
