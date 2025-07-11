<?php

namespace App\Mainframe\Modules\InAppNotifications\Traits;

use App\InAppNotification;

/** @mixin InAppNotification $this */
trait InAppNotificationProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  InAppNotification  $element
     * @return $this
     */
    public function fill($element)
    {
        $element->setDefaults();

        return $this;
    }

    /**
     * @param  InAppNotification  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'name' => 'required|between:1,255|'.'unique:in_app_notifications,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
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
     * @param  InAppNotification  $element
     * @return $this
     */
    // public function saving($element) { return $this; }
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

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

}
