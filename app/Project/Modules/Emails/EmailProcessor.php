<?php

namespace App\Project\Modules\Emails;

use App\Email;

class EmailProcessor extends \App\Mainframe\Modules\Emails\EmailProcessor
{
    use EmailProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Section - Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var Email */
    public $element;
    // public $immutables;
    // public $transitions;
    // public $trackedFields;

    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Pre-fill model before running rule based validations
    //  *
    //  * @param  Email  $element
    //  * @return $this
    //  */
    // public function fill($element) { return parent::fill($element); }

    // /**
    //  * @param  Email  $element
    //  * @param  array  $merge
    //  * @return array
    //  */
    // public static function rules($element, $merge = []) { return parent::rules($element, $merge); }

    /* Further customize error messages and attribute names by overriding */
    // public static function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */

    // /**
    //  * @param  Email  $element
    //  * @return $this
    //  */
    // public function saving($element) { return parent::saving($element); }
    // public function creating($element) { return parent::creating($element); }
    // public function updating($element) { return parent::updating($element); }
    // public function created($element) { return parent::created($element); }
    // public function updated($element) { return parent::updated($element); }
    // public function saved($element) { return parent::saved($element); }
    // public function deleting($element) { return parent::deleting($element); }
    // public function deleted($element) { return parent::deleted($element); }

    /*
    |--------------------------------------------------------------------------
    | Section: Immutables and transitions
    |--------------------------------------------------------------------------
    */

    // public function transitions() { return parent::transitions(); }
    // public function immutables() { return parent::immutables(); }

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
