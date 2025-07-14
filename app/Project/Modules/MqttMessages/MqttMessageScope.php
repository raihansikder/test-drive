<?php

namespace App\Project\Modules\MqttMessages;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/** @mixin MqttMessage */
trait MqttMessageScope
{
    /*
    |--------------------------------------------------------------------------
    | Note: Use this helper to write query local query scopes
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Scope a query to only include active users.
    //  * Usage: $mqttMessage = MqttMessage::popular()->active()->orderBy('created_at')->get();
    //  */
    // public function scopeActive(Builder $query): void
    // {
    //     $query->where('active', 1);
    // }


}
