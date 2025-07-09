<?php

namespace App\Mainframe\Features\Modular\Immutable;

use App\User;
use App\Mainframe\Features\Core\Traits\HasModule;

class Immutable
{
    use HasModule, HasImmutables;

    /**
     * Array of database field names that are immutable
     *
     * @var array
     */
    public $immutables = [];
    /**
     * Module
     *
     * @var \App\Module
     */
    public $module;
    /**
     * Database table name of the module
     *
     * @var string
     */
    public $table;
    /**
     * Database table fields
     *
     * @var array
     */
    public $fields;
    /**
     * Mainframe element/model
     *
     * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule
     */
    public $element;
    /**
     * User
     *
     * @var \App\User|\Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    /**
     * Model processor
     *
     * @var \App\Project\Features\Modular\Validator\ModelProcessor
     */
    public $processor;

    /**
     * @param  $element
     * @param  User|null  $user
     */
    public function __construct($element, $user = null)
    {

        $this->element = $element;
        $this->user = $user ?? user();

        $this->setModule($this->element->module());
        $this->setFields();
    }

    public function setFields()
    {
        if ($this->model) {
            $this->fields = $this->model->tableColumns();
        }

        return $this;
    }

    /**
     * @param $immutables
     * @return void
     * @alias addImmutables
     */
    public function add($immutables = [])
    {
        $this->addImmutables($immutables);
    }

    /**
     * @param  \App\Project\Features\Modular\Validator\ModelProcessor|mixed  $processor
     * @return Immutable
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;
        return $this;
    }
}
