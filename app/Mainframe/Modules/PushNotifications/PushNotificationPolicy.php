<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class PushNotificationPolicy extends BaseModulePolicy
{
    use PushNotificationPolicyTrait;
}
