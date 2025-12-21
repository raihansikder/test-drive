<?php

namespace App\Mainframe\Features\Core;

use App\Mainframe\Features\Modular\BaseModule\Traits\HasElement;
use App\Mainframe\Features\Modular\BaseModule\Traits\HasHidden;
use App\Mainframe\Features\Modular\BaseModule\Traits\ViewProcessorTrait;
use App\Mainframe\Features\Modular\Immutable\HasImmutables;
use App\Mainframe\Features\Report\Traits\ReportViewProcessorTrait;
use App\Module;

class ViewProcessor
{
    use HasElement, HasHidden, HasImmutables, ReportViewProcessorTrait, ViewProcessorTrait;

    /** @var \App\User|null */
    public $user;

    /**
     * Variables shared in view blade
     *
     * @var array
     */
    public $vars;

    /**
     * Type of view i.e., create, edit, index
     *
     * @var string
     */
    public $type;

    /** @var Module */
    public $module;

    /** @var \Illuminate\Database\Eloquent\Builder */
    public $model;

    /** @var \App\Mainframe\Features\Modular\BaseModule\BaseModule */
    public $element;

    /** @var bool */
    public $editable;

    /**
     * Fields that cannot be editable in the view
     *
     * @var array
     */
    public $immutables = [];

    /**
     * Fields hidden in the view
     *
     * @var array
     */
    public $hidden = [];

    /** @var \App\Mainframe\Features\Datatable\Datatable */
    public $datatable;

    public function __construct($element = null)
    {
        $this->user = user();
        $this->setElement($element);
        if ($this->isEditing()) {
            $this->mergeImmutables($element->processor()->getImmutables());
        }
    }
}
