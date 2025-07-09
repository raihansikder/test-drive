<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class EmailPolicy extends BaseModulePolicy
{
    use EmailPolicyTrait;
}
