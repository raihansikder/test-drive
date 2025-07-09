<?php

namespace App\Mainframe\Modules\Groups;

use App\Mainframe\Modules\Groups\Traits\GroupPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class GroupPolicy extends BaseModulePolicy
{
    use GroupPolicyTrait;
}
