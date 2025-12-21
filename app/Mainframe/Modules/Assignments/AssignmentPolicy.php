<?php

namespace App\Mainframe\Modules\Assignments;

use App\Mainframe\Modules\Assignments\Traits\AssignmentPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class AssignmentPolicy extends BaseModulePolicy
{
    use AssignmentPolicyTrait;
}
