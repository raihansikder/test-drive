<?php

namespace App\Mainframe\Modules\Reports;

use App\Mainframe\Modules\Reports\Traits\ReportTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Report extends BaseModule
{
    use ReportTrait;

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
        'code',
        'title',
        'description',
        'parameters',
        'type',
        'version',
        'module_id',
        'is_module_default',
        'tags',
        'is_tenant_editable',
        'is_active',
    ];

    /** @var array Report types */
    public static $types = [
        'Module Generic Report' => 'Module Generic Report',
    ];

}
