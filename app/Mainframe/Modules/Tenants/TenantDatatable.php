<?php

namespace App\Mainframe\Modules\Tenants;

use App\Mainframe\Modules\Tenants\Traits\TenantDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class TenantDatatable extends ModuleDatatable
{
    use TenantDatatableTrait;
}
