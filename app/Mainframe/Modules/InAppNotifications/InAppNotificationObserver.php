<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class InAppNotificationObserver extends BaseModuleObserver
{
    use InAppNotificationObserverTrait;
}
