<?php

namespace App\Mainframe\Modules\Comments\Traits;

use App\Comment;

/** @mixin  \App\Mainframe\Modules\Comments\CommentProcessor
 */
trait CommentProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Pre-fill the model before running rule-based validations
    //  *
    //  * @param  Comment  $element
    //  * @return $this
    //  */
    // public function fill($element)
    // {
    //     // $element->populate(); 
    //     return $this;
    // }

    /**
     * @param  Comment  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'name' => 'required|between:1,100|'.'unique:comments,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'body' => 'required',
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
     * @param  Comment  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate. 
        // If valid, proceed
        // if($this->isValid()){                
        // }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    // /**
    //  * @param  Comment  $element
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
