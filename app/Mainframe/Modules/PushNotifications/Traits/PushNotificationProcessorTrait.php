<?php

namespace App\Mainframe\Modules\PushNotifications\Traits;

use App\PushNotification;

/** @mixin \App\Mainframe\Modules\PushNotifications\PushNotificationProcessor $this */
trait PushNotificationProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Pre-fill model before running rule based validations
     *
     * @param  PushNotification  $element
     * @return $this
     */
    public function fill($element)
    {
        $element->setDeviceToken();

        return $this;
    }

    /**
     * @param  PushNotification  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'device_token' => 'required|between:10,500',
            'user_id' => 'required|integer|exists:users,id,is_active,"1"',
            'body' => 'required|between:1,1024',
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

    // public function saving($element) { return $this; }
    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param PushNotification $element
     * @return $this
     */
    public function saved($element)
    {
        $element->send();
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

}
