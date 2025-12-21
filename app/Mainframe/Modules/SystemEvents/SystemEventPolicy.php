<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Mainframe\Modules\SystemEvents\Traits\SystemEventPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class SystemEventPolicy extends BaseModulePolicy
{
    use SystemEventPolicyTrait;
}
