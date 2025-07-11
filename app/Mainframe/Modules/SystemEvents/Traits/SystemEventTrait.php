<?php

namespace App\Mainframe\Modules\SystemEvents\Traits;

use App\User;
use App\SystemEvent;

/** @mixin \App\SystemEvent */
trait SystemEventTrait
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
    public function user() { return $this->belongsTo(User::class); }


    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * @return $this
     */
    public function setNameExt()
    {
        $this->name_ext = $this->name;

        if ($this->provider) {
            $this->name_ext .= "-".$this->provider;
        }
        if ($this->environment) {
            $this->name_ext .= "-".$this->environment;
        }
        if ($this->source) {
            $this->name_ext .= "(".$this->source.")";
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * Store system event in DB. Events are saved asynchronously using a job.
     *
     * [params]
     *  - provider      : The event provider. The entity that generates the event. Default:SystemEventProvider
     *  - source        : Source of the event. BE, FE, App etc. Default:BE
     *  - environment   : local, development, production. Default: BE .env
     *  - type          : Issue, Event, Log. Default: Event
     *  - user_id       : Default: current user id
     *  - details       : An array or string
     *  - tags          : Array or csv
     *
     * @param  string  $name
     * @param  mixed  $params  This can be given as an array with keys
     * @param  null  $model
     * @param  null  $details
     * @return void
     * @noinspection DuplicatedCode
     */
    public static function log(string $name, $params = null, $model = null, $details = null)
    {
        $systemEvent = new SystemEvent();

        $systemEvent->name = $name;

        // If param is given as an array, use it to fill the model.
        if (is_array($params)) {
            $systemEvent->fill($params);
        } elseif (is_string($params)) { // If the param is given as a string, then use it to fill the details
            $systemEvent->details = $params;
        }

        // If $details is explicitly given, use it to fill.
        if ($details) {
            $systemEvent->details = $details;
        }

        $systemEvent->occurred_at = now(); // Set time

        // If $model is given, fill model related fields
        if ($model) {
            $systemEvent->module_id = $model->module()->id;
            $systemEvent->element_id = $model->id;
            $systemEvent->element_uuid = $model->uuid;
        }

        $systemEvent->processor()->saveAsync();
    }

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
