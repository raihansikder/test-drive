<?php

namespace App\Mainframe\Modules\Users\Traits;

use Arr;
use App\User;

trait UserDatatableTrait
{
    /**
     * Define Query Source
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function source()
    {
        return User::query()
            ->with('groups:id,title')
            ->leftJoin('users as updater', 'updater.id', 'users.updated_by');
    }

    /**
     * Define grid SELECT statement and HTML column name.
     *
     * @return array
     */
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.name', 'name', 'Name'],
            [$this->table.'.email', 'email', 'Email'],
            [$this->table.'.group_ids', 'group_ids', 'Group'],
            ['updater.name', 'user_name', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }

    /**
     * Apply filter on the query.
     *
     * @param $query \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function filter($query)
    {
        $query = parent::filter($query);

        if ($groupIds = Arr::wrap(request('group_id'))) {
            $query->whereHas('groups', function ($query) use ($groupIds) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                return $query->whereIn('groups.id', $groupIds);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Apply date range picker filter
        |--------------------------------------------------------------------------
        */
        if ($val = request('created_at_from')) { // From date range picker
            $query->where('users.created_at', '>=', date_create($val)->format('Y-m-d 00:00:00'));
        }

        if ($val = request('created_at_till')) { // From date range picker
            $query->where('users.created_at', '<=', date_create($val)->format('Y-m-d 23:59:59'));
        }
        /*---------------------------------------------------------------___-----*/

        return $query;
    }

    /**
     * Modify datatable values
     *
     * @return \Yajra\DataTables\DataTableAbstract
     * @var $dt \Yajra\DataTables\DataTableAbstract
     */
    public function modify($dt)
    {
        $dt = parent::modify($dt);

        // Next modify each column content
        if ($this->hasColumn('email')) {
            $dt->editColumn('email', '<a href="{{ route(\''.$this->module->name.'.edit\', $id) }}">{{$email}}</a>');
        }

        // Show group name
        if ($this->hasColumn('group_ids')) {
            $dt->editColumn('group_ids', function ($row) {
                /** @var \App\User $row */
                return implode(',', $row->groups->pluck('title')->toArray());
            });
        }

        return $dt;
    }
}
