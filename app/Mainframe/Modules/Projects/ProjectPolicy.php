<?php

namespace App\Mainframe\Modules\Projects;

use App\Mainframe\Modules\Projects\Traits\ProjectPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class ProjectPolicy extends BaseModulePolicy
{
    use ProjectPolicyTrait;
}
