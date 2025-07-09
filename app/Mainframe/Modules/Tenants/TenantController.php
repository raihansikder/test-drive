<?php

namespace App\Mainframe\Modules\Tenants;

use App\Mainframe\Modules\Tenants\Traits\TenantControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class TenantController extends ModularController
{
    use TenantControllerTrait;
}
