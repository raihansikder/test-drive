<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationTrait;

class InAppNotification extends BaseModule
{
    use InAppNotificationTrait;

    /**
     * Disable auditing
     *
     * @var bool
     */
    public static $auditingDisabled = true;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'notifiable_type',
        'notifiable_id',
        'module_id',
        'element_id',
        'name',
        'user_id',
        'type',
        'event',
        'subtitle',
        'body',
        'images',
        'data',
        'order',
        'is_visible',
        'announcement_id',
        'accepts_response',
        'response_options',
        'response',
        'responded_at',
        'read_at',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['data' => 'array',];
    // protected $with = [];
    // protected $appends = ['data_json', 'response_json', 'response_options_json', 'images_json',];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    // Note: Place boot() method in project class

}
