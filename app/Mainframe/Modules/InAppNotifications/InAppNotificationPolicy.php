<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class InAppNotificationPolicy extends BaseModulePolicy
{
    use InAppNotificationPolicyTrait;
}
