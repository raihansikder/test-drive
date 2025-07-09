<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationPolicyTrait;

class InAppNotificationPolicy extends BaseModulePolicy
{
    use InAppNotificationPolicyTrait;
}
