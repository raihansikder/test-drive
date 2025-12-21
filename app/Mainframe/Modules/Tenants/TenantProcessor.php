<?php

namespace App\Mainframe\Modules\Tenants;

use App\Mainframe\Modules\Tenants\Traits\TenantProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class TenantProcessor extends ModelProcessor
{
    use TenantProcessorTrait;
}
