<?php

namespace App\Mainframe\Modules\Tenants;

use App\Mainframe\Modules\Tenants\Traits\TenantViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class TenantViewProcessor extends BaseModuleViewProcessor
{
    use TenantViewProcessorTrait;
}
