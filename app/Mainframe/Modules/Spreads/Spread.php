<?php

namespace App\Mainframe\Modules\Spreads;

use App\Mainframe\Modules\Spreads\Traits\SpreadTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Spread extends BaseModule
{
    use SpreadTrait;

    /**
     * Disable auditing
     *
     * @var bool
     */
    public static $auditingDisabled = true;

    protected $moduleName = 'spreads';
    protected $table = 'spreads';
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
        'spreadable_type',
        'spreadable_id',
        'module_id',
        'element_id',
        'element_uuid',
        'key',
        'tag',
        'relates_to',
        'related_id',
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

}
