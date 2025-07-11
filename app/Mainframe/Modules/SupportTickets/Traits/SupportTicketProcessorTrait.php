<?php

namespace App\Mainframe\Modules\SupportTickets\Traits;

use App\SupportTicket;

/** @mixin \App\Mainframe\Modules\SupportTickets\Traits\SupportTicketProcessorTrait */
trait SupportTicketProcessorTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section - Validation
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Pre-fill the model before running rule-based validations
    //  *
    //  * @param  SupportTicket  $element
    //  * @return $this
    //  * @noinspection PhpExpressionResultUnusedInspection
    //  */
    // public function fill($element)
    // {
    //     $element->populate();
    //     return $this;
    // }

    /**
     * @param  SupportTicket  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,255',
            'contact_no' => 'required',
            'primary_category_id' => 'required',
            // 'secondary_category_id' => 'required',
            'details' => 'required',
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
     * @param  SupportTicket  $element
     * @return $this
     */
    public function saving($element)
    {
        // Validate. 
        // If valid, proceed
        if ($this->isValid()) {
            $element->denormalize()->setNameExt()->fillSupportTicketTagNames();
        }

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function creating($element)
    {
        $element->status_name = SupportTicket::SUPPORT_TICKET_STATUS_NEW;

        return $this;
    }

    // public function updating($element) { return $this; }
    public function created($element)
    {
        $element->sendEmail();

        return $this;
    }
    // public function updated($element) { return $this; }

    /**
     * @param  SupportTicket  $element
     * @return $this
     */
    public function saved($element)
    {
        // $element->refresh(); // Re-hydrate. Get the updated model(and relations) before using.

        if ($element->status_name != SupportTicket::SUPPORT_TICKET_STATUS_NEW && $this->fieldHasChanged(['status_name'])) {
            $element->sendStatusUpdateEmail();
        }

        return $this;
    }
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
