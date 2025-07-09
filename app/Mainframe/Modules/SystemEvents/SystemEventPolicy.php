<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\SystemEvents\Traits\SystemEventPolicyTrait;

class SystemEventPolicy extends BaseModulePolicy
{
    use SystemEventPolicyTrait;
}
