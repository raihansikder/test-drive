<?php

namespace App\Mainframe\Modules\Countries;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\Countries\Traits\CountryTrait;

class Country extends BaseModule
{
    use CountryTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'uuid',
        'project_id',
        'tenant_id',
        'name',
        'name_ext',
        'slug',
        'code',
        'country_id',
        'iso2',
        'country_short_name',
        'country_long_name',
        'iso3',
        'numcode',
        'un_member',
        'calling_code',
        'cctld',
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
    // public static $types = [];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    // Note: Place boot() method in project class

}
