<?php

namespace App\Mainframe\Modules\Assignments\Traits;

use Str;
use App\User;
use App\Email;
use App\Module;

/** @mixin \App\Mainframe\Modules\Assignments\Assignment */
trait AssignmentTrait
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

    public function assignable() { return $this->morphTo(); }

    public function assignee() { return $this->belongsTo(User::class, 'assignee_user_id'); }

    public function assignedBy() { return $this->belongsTo(User::class, 'created_by'); }

    public function relatedModule() { return $this->belongsTo(Module::class, 'module_id'); }

    public function user() { return $this->belongsTo(User::class, 'created_by'); }

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
    //     return $this;
    // }

    /**
     * Set name
     * Example code
     *
     * @return $this
     */
    public function setName()
    {
        $this->name = 'Assignment Created for '.Str::singular(optional($this->assignable)->module()->title)
            ."(#".pad(optional($this->assignable)->id).") at ".$this->created_at;

        return $this;
    }

    /**
     * @return $this
     */
    public function setNameExt()
    {
        $this->name_ext = $this->name;

        return $this;
    }

    /**
     * @return $this|void
     */
    public function sendEmail()
    {
        if (!count($this->emailRecipients())) {
            return $this;
        }
        /*
        |--------------------------------------------------------------------------
        | Step 1. Save the \App\Email entry
        |--------------------------------------------------------------------------
        */
        $email = new Email();
        $email->subject = 'Assignment has been created for '.optional($this->assignee)->name;
        $email->to = $this->emailRecipients();
        $email->html = view($this->emailTemplate(), ['element' => $this]);
        $email->name = now()." | ".$email->subject;
        $email->module_id = $this->assignable->module()->id;
        $email->element_id = $this->assignable->id;
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
     * Get email template
     *
     * @return string
     */
    public function emailTemplate()
    {
        return $this->emailTemplate;
    }

    /**
     * @return array
     */
    public function emailRecipients()
    {
        $emails = [];

        # Include creator email
        if ($this->creator) {
            $emails[] = $this->creator->email;
        }

        # Include assignee email
        if ($this->assignee) {
            $emails[] = $this->assignee->email;
        }

        return array_unique(array_filter($emails));
    }


    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
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
    */

}
