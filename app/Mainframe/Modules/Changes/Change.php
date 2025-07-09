<?php

namespace App\Mainframe\Modules\Changes;

use App\Mainframe\Modules\Changes\Traits\ChangeTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Change extends BaseModule
{
    use ChangeTrait;

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
        'changeable_id',
        'changeable_type',
        'module_id',
        'element_id',
        'element_uuid',
        'field',
        'old',
        'new',
        'note',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];

    /*
    |--------------------------------------------------------------------------
    | Options
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
