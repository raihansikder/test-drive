<?php

namespace App\Mainframe\Features\Modular\BaseModule\Traits;

use App\Module;

trait HasElement
{
    /** @var Module */
    public $module;

    /** @var \Illuminate\Database\Eloquent\Builder */
    public $model;

    /** @var \App\Mainframe\Features\Modular\BaseModule\BaseModule|\Illuminate\Database\Eloquent\Model|mixed */
    public $element;

    /**
     * Set an element and based on that set the module, model and add immutables
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule|\Illuminate\Database\Eloquent\Model|mixed  $element
     * @return $this
     */
    public function setElement(mixed $element)
    {
        if (! $element) {
            return $this;
        }

        $this->element = $element;

        $this->setModule($element->module())
            ->setModel($element->newInstance());

        // if ($this->isEditing()) {
        //     $this->addImmutables($element->processor()->getImmutables());
        // }

        return $this;
    }

    /**
     * Set module
     *
     * @param  \App\Module  $module
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Set model
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule  $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }
}
