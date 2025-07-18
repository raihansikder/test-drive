<?php

namespace App\Mainframe\Features\Form;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;

class Input extends Form
{
    public $var;
    public $containerClass;
    public $label;
    public $labelClass;
    public $type;
    public $name;
    public $id;
    public $value;
    public $oldInput;
    public $params;
    public $isEditable;
    public $isHidden;
    public $tooltip;

    /**
     * Input constructor.
     *
     * @param  BaseModule  $element
     * @param  array  $var
     */
    public function __construct($var = [], $element = null)
    {
        parent::__construct($var, $element);

        $this->containerClass = $this->var['container_class'] ?? $this->var['div'] ?? 'col-md-3';
        $this->label = $this->var['label'] ?? null;
        $this->labelClass = $this->var['label_class'] ?? null;
        $this->type = $this->var['type'] ?? null;
        $this->value = $this->var['value'] ?? $this->var['val'] ?? null;
        $this->oldInput = $this->old();
        $this->name = $this->var['name'] ?? Str::random(8);
        $this->params = $this->var['params'] ?? [];
        $this->isEditable = $this->var['editable'] ?? true; // $this->getEditable();
        $this->isHidden = $this->var['hidden'] ?? in_array($this->name, $this->hiddenFields);
        $this->tooltip = $this->var['tooltip'] ?? null;

        // Force add form-control class
        $this->params['id'] = $this->var['id'] ?? $this->params['id'] ?? $this->nameToId();
        $this->id = $this->params['id'];

        // Force add form-control class
        $this->params['class'] = $this->var['class'] ?? $this->params['class'] ?? '';

        $this->params['class'] .= ' form-control '.$this->nameWithoutArrayLiteral().' ';

        // Add id in the class too
        if ($this->nameWithoutArrayLiteral() != $this->params['id']) {
            $this->params['class'] .= $this->params['id'];
        }

        // Place-holder
        $this->params['placeholder'] = $this->var['placeholder'] ?? $this->params['placeholder'] ?? '';
    }

    /**
     * Get old input
     *
     * @return null|array|Request|string
     */
    public function old()
    {
        if (request()->has($this->name)) {
            return request($this->name);
        }

        return request()->old($this->name);
    }

    /**
     * Convert name to id
     *
     * @return string
     */
    public function nameToId()
    {
        // Change name[i][j] to ID name_i_j
        $id = $this->name;
        $id = str_replace(['[', ']', '__'], '_', $id);
        $id = trim($id, '_');

        // For name[] change the ID to name_XXXXXX
        if ($id.'[]' == $this->name) {
            $id .= '_'.$this->uid;
        }

        return $id;
    }

    /**
     * Remove [] from input name
     *
     * @return mixed|string
     */
    public function nameWithoutArrayLiteral()
    {
        return explode('[', $this->name)[0];
    }

    /**
     * Set is hidden
     *
     * @return $this
     */
    public function setIsHidden()
    {
        $this->isHidden = $this->var['hidden'] ?? in_array($this->name, $this->hiddenFields);

        return $this;
    }

    /**
     * Print value
     *
     * @return null|array|Request|string
     */
    public function print()
    {
        return $this->value();
    }

    /**
     * Derive value
     *
     * @return null|array|Request|string
     */
    public function value()
    {
        // if ($this->value) { // didn't work for 0 or null value
        //     return $this->value;
        // }

        if (array_key_exists('value', $this->var) && isset($this->var['value'])) {
            return $this->var['value'];
        }

        if (array_key_exists('val', $this->var) && isset($this->var['val'])) {
            return $this->var['val'];
        }

        // Retain null input.
        if (array_key_exists($this->name, request()->old())) {
            return $this->old(); // Also takes request() in consideration
        }

        // Retain 0 input
        if ($this->old() != null) {
            return $this->old();
        }

        if ($this->element && isset($this->element->{$this->name})) {
            return $this->element->{$this->name};
        }

        return '';
    }

    /**
     * Class of the main div
     * form-group {divClass} has-error? {uid}
     *
     * @return string
     */
    public function containerClasses()
    {
        return 'form-group'.' '.$this->containerClass.' '.$this->errors->first($this->name, 'has-error').' '.$this->uid;
    }

    public function label()
    {
        return $this->label;
    }

}
