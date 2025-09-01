<?php

namespace App\Mainframe\Modules\ModuleGroups\Traits;

use Str;
use App\Module;
use App\ModuleGroup;
use Illuminate\Validation\Rule;

/** @mixin \App\Mainframe\Modules\Modules\ModuleProcessor $this */
trait ModuleGroupProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  ModuleGroup  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate();


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
            // 'name' => [
            //     'required',
            //     'between:1,255',
            //     Rule::unique('module_groups', 'name')
            //         ->ignore($element->id)->whereNull('deleted_at'),
            //     'Regex:/^[a-z\-]+$/',
            // ],
            'title' => [
                'required',
                'between:1,255',
                Rule::unique('module_groups', 'name')
                    ->ignore($element->id)->whereNull('deleted_at'),
                // Rule::unique('modules', 'name')->whereNull('deleted_at'),
            ],
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
        $element->name = 'mg-'.Str::kebab($element->title);
        $element->parent_id = $element->parent_id ?: 0;
        $element->level = $element->level ?: 0;
        $element->order = $element->order ?: 999;
        $element->route_name = $element->name;
        $element->color_css = $element->color_css ?: 'navy';
        $element->icon_css = $element->icon_css ?: 'fa fa-cube';

        // First validate
        $this->invalidIfModuleExistsWithSameName();
        // Then do further processing
        if ($this->isValid()) {
            $element->route_path = $element->name;
            $element->default_route = $element->route_name.'.index';
        }

        return $this;
    }
    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  ModuleGroup  $element
     * @return $this
     */
    public function saved($element)
    {
        // $element->refresh(); // Get the updated model(and relations) before using.

        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        $this->notice('Cache cleared.');

        return $this;
    }
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

    /**
     * Invalid if module exists with same name
     *
     * @return $this
     */
    public function invalidIfModuleExistsWithSameName()
    {
        if (Module::where('name', $this->element->name)->exists()) {
            $this->error('Conflict with existing module. Please put a different value.', 'title');
        }

        return $this;
    }


}
