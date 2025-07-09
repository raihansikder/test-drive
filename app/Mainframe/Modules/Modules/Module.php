<?php

namespace App\Mainframe\Modules\Modules;

use App\Mainframe\Modules\Modules\Traits\ModuleTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Module extends BaseModule
{
    use ModuleTrait;

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
        'project_id',
        'tenant_id',
        'title',
        'description',
        'module_table',
        'route_path',
        'route_name',
        'class_directory',
        'namespace',
        'model',
        'policy',
        'processor',
        'controller',
        'view',
        'parent_id',
        'module_group_id',
        'level',
        'order',
        'default_route',
        'color_css',
        'icon_css',
        'is_active',
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
