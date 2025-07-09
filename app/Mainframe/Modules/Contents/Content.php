<?php

namespace App\Mainframe\Modules\Contents;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\Contents\Traits\ContentTrait;

class Content extends BaseModule
{
    use ContentTrait;

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
        'key',
        'title',
        'body',
        'parts',
        'help_text',
        'tags',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    protected $appends = ['parts_array'];
    protected $tagFields = ['tags'];

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
