<?php

namespace App\Mainframe\Modules\Projects;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\Projects\Traits\ProjectTrait;

class Project extends BaseModule
{
    use ProjectTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'uuid',
        'name',
        'code',
        'name',
        'description',
        'configuration',
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
