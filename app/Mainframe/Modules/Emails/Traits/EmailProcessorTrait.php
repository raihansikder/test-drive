<?php

namespace App\Mainframe\Modules\Emails\Traits;

use App\Email;

/** @mixin \App\Mainframe\Modules\Emails\EmailProcessor */
trait EmailProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    /**
     * @param  Email  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'to' => 'required',
            'subject' => 'required',
            'html' => 'required',
        ];

        return array_merge($rules, $merge);
    }

    /**
     * Pre-fill the model before running rule-based validations
     *
     * @param  Email  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); 
        return $this;
    }

    /* Further customize error messages and attribute names by overriding */
    // public static function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  Email  $element
     * @return $this
     */
    public function saving($element)
    {
        // First validate
        $this->checkRecipients();

        // Then do further processing
        if ($this->isValid()) {
            $element->setStatusName()->setName()->setNameExt()->turnCsvFieldToArray();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    // /**
    //  * @param  Email  $element
    //  * @return $this
    //  */
    // public function saved($element)
    // {
    //     // $element->refresh(); // Get the updated model(and relations) before using.
    //     // The refresh method will re-hydrate the existing model using fresh data from the database.
    //
    //     return $this;
    // }

    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Immutables and transitions
    |--------------------------------------------------------------------------
    */
    //

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

    public function checkRecipients()
    {
        // Todo-Complete the logic
        return $this;
    }
}
