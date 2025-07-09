<?php

namespace App\Mainframe\Modules\Reports\Traits;

use App\Report;
use App\Mainframe\Modules\Reports\ReportProcessor;

/** @mixin ReportProcessor $this */
trait ReportProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Rules.
    |--------------------------------------------------------------------------
    |
    | Write the laravel validation rules
    */
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
            // 'name' => 'required|between:1,255|unique:modules,name,'.(isset($element->id) ? (string) $element->id : 'null').',id,deleted_at,NULL',
            'name' => 'required|between:1,255',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /*
     |--------------------------------------------------------------------------
     | Section - Processor Events
     |--------------------------------------------------------------------------
     */

    /**
     * @param  Report  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate. 
        // If valid, proceed
        if ($this->isValid()) {
            $element->title = $element->name;
            $this->setTenantEditable();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }
    // public function saved($element) { return $this; }
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

    /**
     * Should be editable by tenant if created by a tenant user
     *
     * @return $this
     */
    public function setTenantEditable()
    {
        if ($this->element->hasColumn('is_tenant_editable')) {
            $this->element->is_tenant_editable = 0;
            if ($this->user->ofTenant()) {
                $this->element->is_tenant_editable = 1;
            }
        }

        return $this;
    }

    public function setTitle()
    {
        $this->element->title = $this->element->title ?? $this->element->name;

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

}
