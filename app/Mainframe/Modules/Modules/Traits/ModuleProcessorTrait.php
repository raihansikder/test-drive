<?php

namespace App\Mainframe\Modules\Modules\Traits;

/** @mixin \App\Mainframe\Modules\Modules\ModuleProcessor */
trait ModuleProcessorTrait
{
    /**
     * Validation rules. For regular expression validation use array instead of pipe
     *
     * @param       $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,255|unique:modules,name,'.(isset($element->id) ? "$element->id" : 'null').',id,deleted_at,NULL',
            'is_active' => 'required|in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /**
     * @param  \App\Module  $element
     * @return $this
     */
    public function saving($element)
    {

        if ($this->isValid()) {
            // Fill default values
            $element->parent_id = (!$element->parent_id) ? 0 : $element->parent_id;
            $element->module_group_id = (!$element->module_group_id) ? 0 : $element->module_group_id;
            $element->level = (!$element->level) ? 0 : $element->level;
            $element->order = (!$element->order) ? 0 : $element->order;
            $element->default_route = (!$element->default_route) ? $element->name.'.index' : $element->default_route;
            $element->color_css = (!$element->color_css) ? 'aqua' : $element->color_css;
            $element->icon_css = (!$element->icon_css) ? 'fa fa-plus' : $element->icon_css;
        }

        return $this;
    }

}
