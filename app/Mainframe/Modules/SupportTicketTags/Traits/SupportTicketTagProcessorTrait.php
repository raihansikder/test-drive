<?php

namespace App\Mainframe\Modules\SupportTicketTags\Traits;

use App\SupportTicketTag;

trait SupportTicketTagProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Pre-fill the model before running rule-based validations
    //  *
    //  * @param  SupportTicketTag  $element
    //  * @return $this
    //  */
    // public function fill($element)
    // {
    //     // $element->populate();
    //     return $this;
    // }

    /**
     * @param  SupportTicketTag  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,100|'.'unique:support_ticket_tags,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
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
     * @param  SupportTicketTag  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate. 
        // If valid, proceed
        if ($this->isValid()) {
            $element->setNameExt();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    // /**
    //  * @param  SupportTicketTag  $element
    //  * @return $this
    //  */
    // public function saved($element)
    // {
    //     // $element->refresh(); // Re-hydrate. Get the updated model(and relations) before using.
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

    // public function transitions() { return $this->transitions; }

    // public function immutables() { return $this->immutables; }

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
