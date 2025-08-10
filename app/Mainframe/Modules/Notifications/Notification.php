<?php

namespace App\Mainframe\Modules\Notifications;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\Notifications\Traits\NotificationTrait;

class Notification extends BaseModule
{
    use NotificationTrait;

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
        'name',
        'type',
        'notifiable_type',
        'notifiable_id',
        'module_id',
        'element_id',
        'element_uuid',
        'data',
        'read_at',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];

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
