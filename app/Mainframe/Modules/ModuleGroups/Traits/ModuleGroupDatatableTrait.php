<?php

namespace App\Mainframe\Modules\ModuleGroups\Traits;

trait ModuleGroupDatatableTrait
{
    /**
     * List of columns to show in datatable
     *
     * @return array[]
     */
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.title', 'title', 'Title'],
            [$this->table.'.name', 'name', 'Name'],
            ['updater.name', 'user_name', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }
}
