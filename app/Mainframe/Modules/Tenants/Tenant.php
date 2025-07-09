<?php

namespace App\Mainframe\Modules\Tenants;

use App\Mainframe\Modules\Tenants\Traits\TenantTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Tenant extends BaseModule
{
    use TenantTrait;

    public const GLOBAL_TENANT_ID = 0; // These elements are accessible by all tenant
    public const NON_TENANT_ID    = null; // Only accessible by admin/non-tenant user

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
        'is_active',
    ];

}
