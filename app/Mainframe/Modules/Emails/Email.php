<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Email extends BaseModule
{
    use EmailTrait;

    public const STATUS_QUEUED    = 'Queued';
    public const STATUS_SENT      = 'Sent';
    public const STATUS_FAILED    = 'Failed';
    public const STATUS_DISCARDED = 'Discarded';
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
        'name_ext',
        'slug',
        'to',
        'cc',
        'bcc',
        'subject',
        'html',
        'status_name',
        'attempts',
        'last_attempted_at',
        'successfully_delivered_at',
        'to_user_id',
        'module_id',
        'element_id',
        'emailable_type',
        'emailable_id',
        'attachments',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        // 'attachments' => 'array',
    ];

    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    public static $emailStatusNameTypes = [
        self::STATUS_QUEUED,
        self::STATUS_SENT,
        self::STATUS_FAILED,
        self::STATUS_DISCARDED,
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    // Note: Place boot() method in project class

}
