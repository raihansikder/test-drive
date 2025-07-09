<?php

namespace App\Mainframe\Modules\ModuleGroups;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\ModuleGroups\Traits\ModuleGroupTrait;

class ModuleGroup extends BaseModule
{
    use ModuleGroupTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'id',
        'uuid',
        'name',
        // 'name_ext',
        // 'slug',
        'title',
        'description',
        'route_path',
        'route_name',
        'parent_id',
        'level',
        'order',
        'default_route',
        'color_css',
        'icon_css',
        'is_visible',
        'is_active',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'deleted_by',
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
