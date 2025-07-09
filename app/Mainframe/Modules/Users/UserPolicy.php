<?php

namespace App\Mainframe\Modules\Users;

use App\Mainframe\Modules\Users\Traits\UserPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class UserPolicy extends BaseModulePolicy
{
    use UserPolicyTrait;
}
