<?php

namespace App\Mainframe\Modules\InAppNotifications\Traits;

use App\User;

/** @mixin \App\InAppNotification */
trait InAppNotificationTrait
{
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
    //     $this->setDefaults();
    //
    //     return $this;
    // }

    public function setDefaults()
    {

        $this->type = $this->type ?? 'generic';
        $this->is_visible = $this->is_visible ?? 1;
        $this->accepts_response = $this->accepts_response ?? 0;
        $this->body = $this->body ?? $this->subtitle;
        $this->data = $this->data ?? json_encode(['user_id' => $this->id, 'type' => $this->id,]);
        $this->is_active = $this->is_active ?? 1;
        $this->order = $this->order ?? 9999;

        $this->setRespondedAt();

        return $this;
    }

    /**
     * Set responded_at
     *
     * @return $this
     */
    public function setRespondedAt()
    {
        if ($this->response && !$this->responded_at) {
            $this->responded_at = now();
        }

        return $this;
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

    public function getResponseJsonAttribute() { return json_decode($this->response); }

    public function getResponseOptionsJsonAttribute() { return json_decode($this->response_options); }

    public function getImagesJsonAttribute() { return json_decode($this->images); }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

    public function user() { return $this->belongsTo(User::class); }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function notifiable() { return $this->morphTo(); }

}
