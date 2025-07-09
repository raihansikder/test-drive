<?php

namespace App\Mainframe\Modules\SupportTickets\Traits;

use App\Email;
use App\Module;
use App\SupportTicketTag;
use App\SupportTicketCategory;

/** @mixin \App\SupportTicket */
trait SupportTicketTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Accessors
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

    public function primaryCategory() { return $this->belongsTo(SupportTicketCategory::class, 'primary_category_id'); }

    public function secondaryCategory() { return $this->belongsTo(SupportTicketCategory::class, 'secondary_category_id'); }

    public function supportTicketTagIds() { return $this->spreadModels('support_ticket_tag_ids'); }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions 
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Populate model
    //  * return $this
    //  */
    // public function populate()
    // {
    //     // Example code
    //     // $this->fillAddress()->setAmounts();
    //     return $this;
    // }

    /**
     * @return $this
     */
    public function setNameExt()
    {
        $this->name_ext = $this->name;

        if ($this->secondaryCategory) {
            $this->name_ext = $this->secondaryCategory->name.' > '.$this->name;
        }

        return $this;
    }

    public function denormalize()
    {
        $this->primary_category_name = optional($this->primaryCategory)->name;
        $this->secondary_category_name = optional($this->secondaryCategory)->name;

        return $this;
    }

    /**
     * Fill the name fields of the support-ticket tags
     *
     * @return $this
     */

    public function fillSupportTicketTagNames()
    {
        if (!$this->support_ticket_tag_ids) {
            $this->support_ticket_tag_names = null;
            $this->support_ticket_tag_names_formatted = null;

            return $this;
        }
        $names = [];
        foreach ($this->support_ticket_tag_ids as $id) {
            $names[] = SupportTicketTag::find($id)->name;
        }
        if (count($names)) {
            $this->support_ticket_tag_names = array_unique($names);
            $this->support_ticket_tag_names_formatted = implode(',', array_unique($names));
        }

        return $this;

    }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * @return $this
     */
    public function sendEmail()
    {
        if (!$this->emailRecipients()) {
            return $this;
        }
        /*
        |--------------------------------------------------------------------------
        | Step 1. Save the \App\Email entry
        |--------------------------------------------------------------------------
        */
        $email = new Email();

        $email->subject = 'Support Ticket (#'.pad($this->id).') Created';
        $email->to = $this->emailRecipients();
        $email->html = view('project.emails.support-ticket-created', ['element' => $this]);
        $email->name = now()." | ".$email->subject;
        $email->module_id = Module::byName($this->moduleName)->id;
        $email->element_id = $this->id;

        $processor = $email->processor()->save();

        /*
        |--------------------------------------------------------------------------
        | Step 2. Send the saved email
        |--------------------------------------------------------------------------
        */
        //dd($processor->isValid());
        if ($processor->isValid()) {
            // $email->send(); // Immediate send (synchronous)
            $email->queue();   // Queue up!! (Preferable)
        }

        return $this;
    }

    /**
     * @return void
     */
    public function sendStatusUpdateEmail()
    {
        /*
        |--------------------------------------------------------------------------
        | Step 1. Save the \App\Email entry
        |--------------------------------------------------------------------------
        */
        $email = new Email();

        $email->subject = 'Support Ticket (#'.pad($this->id).') status has been updated to '.$this->status_name;
        $email->to = $this->emailRecipients();
        $email->html = view('project.emails.support-ticket-updated', ['element' => $this]);
        $email->name = now()." | ".$email->subject;
        $email->module_id = Module::byName($this->moduleName)->id;
        $email->element_id = $this->id;

        $processor = $email->processor()->save();

        /*
        |--------------------------------------------------------------------------
        | Step 2. Send the saved email
        |--------------------------------------------------------------------------
        */
        //dd($processor->isValid());
        if ($processor->isValid()) {
            // $email->send(); // Immediate send (synchronous)
            $email->queue();   // Queue up!! (Preferable)
        }

    }

    /**
     * Email recipients
     *
     * @return array
     */
    public function emailRecipients()
    {
        $emails = [];

        # Add primary_category email recipients
        if ($this->primaryCategory && $this->primaryCategory->email_recipients) {
            foreach ($this->primaryCategory->email_recipients as $emailRecipient) {
                $emails[] = $emailRecipient;
            }
        }
        # Add secondary_category email recipients
        if ($this->secondaryCategory && $this->secondaryCategory->email_recipients) {
            foreach ($this->secondaryCategory->email_recipients as $emailRecipient) {
                $emails[] = $emailRecipient;
            }
        }
        # Add creator email
        if ($this->creator) {
            $emails[] = $this->creator->email;
        }

        return array_values(array_unique(array_filter($emails)));
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    // Static helper functions

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    |
    | An element can be editable or non-editable based on its internal status
    | This is not related to any user, rather it is a model's individual state
    | For example - A confirmed quotation should not be editable regardless
    | Of who is attempting to edit it.
    |
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }
    // public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    |
    */
    // /**
    //  * Notify admins when quote is accepted
    //  */
    // public function sendSomeNotification()
    // {
    //     Notification::send($users, new NotificationClass($this));
    // }

}
