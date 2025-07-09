<?php

namespace App\Mainframe\Modules\Assignments;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\Assignments\Traits\AssignmentPolicyTrait;

class AssignmentPolicy extends BaseModulePolicy
{
    use AssignmentPolicyTrait;
}
