<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationPolicyTrait;

class PushNotificationPolicy extends BaseModulePolicy
{
    use PushNotificationPolicyTrait;
}
