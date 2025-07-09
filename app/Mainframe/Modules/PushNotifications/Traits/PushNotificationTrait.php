<?php

namespace App\Mainframe\Modules\PushNotifications\Traits;

use App\User;
use App\PushNotification;
use App\InAppNotification;
use App\Mainframe\Jobs\JobSendPushNotifications;

/** @mixin PushNotification $this */
trait PushNotificationTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section:  Accessors
    |--------------------------------------------------------------------------
    */
    // public function getFirstNameAttribute($value) { return ucfirst($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */
    // public function setFirstNameAttribute($value) { $this->attributes['first_name'] = strtolower($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */
    public function getDataJsonAttribute() { return json_decode($this->data); }

    public function getApiResponseJsonAttribute() { return json_decode($this->api_response); }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */
    public function user() { return $this->belongsTo(User::class); }

    public function inAppNotification() { return $this->belongsTo(InAppNotification::class); }

    public function notifiable() { return $this->morphTo(); }
    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions 
    |--------------------------------------------------------------------------
    */
    /**
     * Populate model
     * return $this
     */
    // public function populate()
    // {
    //     $this->setDeviceToken();
    //     return $this;
    // }

    /**
     * Set Device Token
     *
     * @return $this
     */
    public function setDeviceToken()
    {

        if ($this->device_token) {
            return $this;
        }
        // if ($this->inAppNotification()->exists() && $user = $this->inAppNotification->user) {
        //     $this->device_token = $user->device_token;
        // }

        if ($this->user->device_token) {
            $this->device_token = $this->user->device_token;
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */
    public function send()
    {
        JobSendPushNotifications::dispatch($this);
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------|
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
