<?php

namespace App\Mainframe\Modules\Emails\Traits;

use Arr;
use Mail;
use App\Email;
use App\Module;
use App\Mainframe\Helpers\Convert;
use App\Mainframe\Jobs\JobSendEmail;
use App\Mainframe\Mails\DefaultEmail;

trait EmailTrait
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

    public function relatedModule() { return $this->belongsTo(Module::class, 'module_id'); }

    public function emailable() { return $this->morphTo(); }

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
    //     // $this->fillAddress()->setAmounts();
    //     return $this;
    // }

    public function setName()
    {
        $this->name = $this->name ?? (now()." | ".$this->subject);
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

    public function setStatusName()
    {
        $this->status_name = $this->status_name ?? Email::STATUS_QUEUED;
        return $this;
    }

    /**
     * Immediately send/dispatch the email
     *
     * @return void
     */
    public function send()
    {
        // Send email
        Mail::to($this->to)
            ->cc($this->cc)
            ->bcc($this->bcc)
            ->send(new DefaultEmail($this));

        $this->updateAttempts();

    }

    /**
     * Update attempts count
     *
     * @return void
     */
    public function updateAttempts()
    {
        $this->attempts++;
        $this->last_attempted_at = now();
        $this->status_name = Email::STATUS_SENT;

        $this->saveQuietly();

    }

    // /**
    //  * Queue the email. Directly uses mail queue
    //  *
    //  * @return void
    //  */
    // public function queue()
    // {
    //     \Illuminate\Support\Facades\Mail::to($this->to)
    //         ->cc($this->cc)
    //         ->bcc($this->bcc)
    //         ->queue(new DefaultEmail($this));
    //
    //     $this->updateAttempts();
    // }

    /**
     * Queue the email
     *
     * @return void
     */
    public function queue()
    {
        // // Check retry condition
        // if ($this->shouldRetry()) {
        //     JobSendEmail::dispatch($this);
        // }

        // Always queue
        JobSendEmail::dispatch($this);
    }

    /**
     * Set status as discarded
     *
     * @return $this
     */
    public function setAsDiscarded()
    {
        $this->status_name = Email::STATUS_DISCARDED;

        return $this;
    }

    /**
     * Check if the email should be discarded
     *
     * @return bool
     */
    public function shouldDiscard()
    {
        return $this->attempts > 9 && $this->status_name == Email::STATUS_FAILED;

    }

    /**
     * Check if email sending should be retried
     *
     * @return bool
     */
    public function shouldRetry()
    {
        $discardedStatus = [
            Email::STATUS_DISCARDED,
            Email::STATUS_SENT,
        ];
        if (in_array($this->status_name, $discardedStatus)) {
            return false;
        }

        return true;
    }

    /**
     * Turn CSV fields to Array
     *
     * @return $this
     */
    public function turnCsvFieldToArray()
    {
        $this->to = Arr::wrap(Convert::csvToArray($this->to));
        $this->cc = Arr::wrap(Convert::csvToArray($this->cc));
        $this->bcc = Arr::wrap(Convert::csvToArray($this->bcc));

        return $this;
    }

}
