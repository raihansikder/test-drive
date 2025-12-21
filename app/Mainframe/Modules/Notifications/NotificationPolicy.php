<?php

namespace App\Mainframe\Modules\Notifications;

use App\Mainframe\Modules\Notifications\Traits\NotificationPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class NotificationPolicy extends BaseModulePolicy
{
    use NotificationPolicyTrait;
}
