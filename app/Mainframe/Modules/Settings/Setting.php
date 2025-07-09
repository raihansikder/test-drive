<?php

namespace App\Mainframe\Modules\Settings;

use App\Mainframe\Modules\Settings\Traits\SettingTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Setting extends BaseModule
{
    use SettingTrait;

    protected $moduleName = 'settings';
    protected $table = 'settings';

    // protected $forceDeleting = false;
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
        'title',
        'type',
        'description',
        'value',
        'tenant_editable',
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
    /**
     * @var array Options for setting type
     */
    public static $types = [
        'boolean' => 'Boolean',
        'string' => 'String',
        'array' => 'Array/Object', // Input Json
        'csv' => 'CSV',
        'file' => 'File',
    ];
}
