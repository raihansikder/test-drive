<?php

namespace App\Mainframe\Modules\Tenants;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Tenants\Traits\TenantProcessorTrait;

class TenantProcessor extends ModelProcessor
{
    use TenantProcessorTrait;
}
