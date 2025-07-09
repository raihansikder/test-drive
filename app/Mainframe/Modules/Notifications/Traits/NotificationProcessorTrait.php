<?php

namespace App\Mainframe\Modules\Notifications\Traits;

use App\Notification;

trait NotificationProcessorTrait
{
    /*
     |--------------------------------------------------------------------------
     | Section - Validation
     |--------------------------------------------------------------------------
     */

    /**
     * Pre-fill model before running rule based validations
     *
     * @param  Notification  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); 
        return $this;
    }

    /**
     * @param  Notification  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'name' => 'required|between:1,100|'.'unique:notifications,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
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

    // /**
    //  * @param  Notification  $element
    //  * @return $this
    //  */
    // public function saving($element)
    // {
    //     // Todo: First validate
    //     // Todo: Then do further processing
    //     // ----------------------------------
    //     // if($this->isValid()){
    //     //     $element->fillSomeData();
    //     //
    //     // }
    //
    //     return $this;
    // }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    // /**
    //  * @param  Notification  $element
    //  * @return $this
    //  */
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
