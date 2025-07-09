<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationTrait;

class PushNotification extends BaseModule
{
    use PushNotificationTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'user_id',
        'device_token',
        'in_app_notification_id',
        'order',
        'type',
        'event',
        'body',
        'data',
        'api_response',
        'multicast_id',
        'success_count',
        'failure_count',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = ['data_json', 'api_response_json'];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    // Note: Place boot() method in project class

}
