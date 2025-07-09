<?php

namespace App\Mainframe\Modules\ModuleGroups\Traits;

use App\ModuleGroup;
use Illuminate\Validation\Rule;
use Str;

/** @mixin \App\Mainframe\Modules\Modules\ModuleProcessor $this */
trait ModuleGroupProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill model before running rule based validations
     *
     * @param  ModuleGroup  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate();
        $element->parent_id = (!$element->parent_id) ? 0 : $element->parent_id;
        $element->level = (!$element->level) ? 0 : $element->level;
        $element->order = (!$element->order) ? 999 : $element->order;
        $element->default_route = (!$element->default_route) ? $element->name.'.index' : $element->default_route;
        $element->color_css = (!$element->color_css) ? 'navy' : $element->color_css;
        $element->icon_css = (!$element->icon_css) ? 'fa fa-cube' : $element->icon_css;

        return $this;
    }

    /**
     * @param  ModuleGroup  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => [
                'required',
                'between:1,255',
                'unique:module_groups,name,'.(isset($element->id) ? (string) $element->id : 'null').',id,deleted_at,NULL',
                Rule::unique('module_groups ', 'name')
                    ->ignore($element->id)->whereNull('deleted_at'),
                'Regex:/^[a-z\-]+$/',
            ],
            'title' => 'required|between:1,255|unique:module_groups,title,'.(isset($element->id) ? (string) $element->id : 'null').',id,deleted_at,NULL',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */
    /**
     * @param  ModuleGroup  $element
     * @return $this
     */
    public function saving($element)
    {
        // First validate
        // Then do further processing
        if ($this->isValid()) {
            $element->route_path = Str::kebab($element->name);
            $element->route_name = Str::kebab($element->name);
        }

        return $this;
    }
    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  ModuleGroup  $element
     * @return \App\Project\Modules\ModuleGroups\ModuleGroupProcessor
     */
    // public function saved($element)
    // {
    //     $element->refresh(); // Get the updated model(and relations) before using.
    //
    //     return $this;
    // }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Other helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

}
