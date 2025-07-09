<?php

namespace App\Mainframe\Modules\Tenants;

use App\Project\Features\Datatable\ModuleDatatable;
use App\Mainframe\Modules\Tenants\Traits\TenantDatatableTrait;

class TenantDatatable extends ModuleDatatable
{
    use TenantDatatableTrait;
}
