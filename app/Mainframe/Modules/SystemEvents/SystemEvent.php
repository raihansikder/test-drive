<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\SystemEvents\Traits\SystemEventTrait;

class SystemEvent extends BaseModule
{
    use SystemEventTrait;

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
        'details',
        'provider',
        'source',
        'environment',
        'version',
        'type',
        'content',
        'module_id',
        'element_id',
        'element_uuid',
        'user_id',
        'occurred_at',
        'tags',
        'url',
        'ip_address',
        'user_agent',
        'name_ext',
        'slug',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'tags' => 'array',
        'details' => 'array',
    ];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];
    public static $envs = ['local', 'development', 'staging', 'production'];
    public static $types = ['Issue', 'Event', 'Log'];
    public static $sources = ['BE', 'Android', 'iOS'];

}
