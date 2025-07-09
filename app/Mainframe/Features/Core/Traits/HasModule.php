<?php

namespace App\Mainframe\Features\Core\Traits;

use App\Module;
use App\Mainframe\Features\Datatable\Datatable;

trait HasModule
{
    public $module;

    public $table;

    /**
     * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public $model;

    /**
     * @param  Module|string  $module
     * @return Datatable|bool
     */
    public function setModule($module)
    {
        if (is_string($module)) {
            $module = Module::byName($module);
        }

        if (!$module) {
            return false;
        }

        $this->module = $module;
        $this->table = $this->module->tableName();
        $this->model = $this->module->modelInstance();

        return $this;
    }

    /**
     * @param  string  $table
     * @return $this
     */
    public function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }
}
