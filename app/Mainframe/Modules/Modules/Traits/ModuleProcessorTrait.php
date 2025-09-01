<?php

namespace App\Mainframe\Modules\Modules\Traits;

use App\ModuleGroup;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'between:1,255',
                'regex:/^[a-z\-]+$/',
                Rule::unique('module_groups', 'name')
                    ->ignore($element->id)->whereNull('deleted_at'),

            ],
            'title' => 'required',
            'module_table' => 'required',
            'route_path' => 'required',
            'route_name' => 'required',
            'class_directory' => 'required',
            'namespace' => 'required',
            'model' => 'required',
            'policy' => 'required',
            'processor' => 'required',
            'controller' => 'required',
            'view_directory' => 'required',
            'is_active' => 'required|in:1,0',
        ];

        return array_merge($rules, $merge);
    }


    /**
     * Custom error messages
     *
     * @param $merge
     * @return string[]
     */
    public static function customErrorMessages($merge = [])
    {
        $messages = [
            'name.regex' => 'The name can only contain lowercase letters and dashes and no space.',
        ];

        return array_merge($messages, $merge);
    }

    /**
     * @param  \App\Module  $element
     * @return $this
     */
    public function saving($element)
    {
        // Run validations
        $this->invalidIfModuleGroupExistsWithSameName();

        // Process if valid
        if ($this->isValid()) {
            $element->parent_id = (!$element->parent_id) ? 0 : $element->parent_id;
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

    /**
     * Invalid if module-group exists with same name
     *
     * @return $this
     */
    public function invalidIfModuleGroupExistsWithSameName()
    {
        if (ModuleGroup::where('name', $this->element->name)->exists()) {
            $this->error('Conflict with existing module. Please put a different value.', 'title');
        }

        return $this;
    }

}
