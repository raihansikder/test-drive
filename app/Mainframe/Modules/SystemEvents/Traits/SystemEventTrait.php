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
     * Store system event
     * @param  string  $name
     * @param  array  $params
     * @param $model
     * @return void
     */
    public static function log(string $name, array $params = [], $model = null)
    {
        $systemEvent = new SystemEvent();

        $systemEvent->name = $name;
        $systemEvent->fill($params);
        $systemEvent->occurred_at = now();

        if ($model) {
            $systemEvent->module_id = $model->module()->id;
            $systemEvent->element_id = $model->id;
            $systemEvent->element_uuid = $model->uuid;
        }

        $systemEvent->processor()->saveAsync();
        // JobStoreSystemEvent::dispatch($systemEvent); // Causes memory leak
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
