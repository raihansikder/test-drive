<?php

namespace App\Mainframe\Modules\Notifications;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\Notifications\Traits\NotificationPolicyTrait;

class NotificationPolicy extends BaseModulePolicy
{
    use NotificationPolicyTrait;
}
