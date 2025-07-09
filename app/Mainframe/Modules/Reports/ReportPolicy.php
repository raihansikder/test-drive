<?php

namespace App\Mainframe\Modules\Reports;

use App\Mainframe\Modules\Reports\Traits\ReportPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class ReportPolicy extends BaseModulePolicy
{
    use ReportPolicyTrait;
}
