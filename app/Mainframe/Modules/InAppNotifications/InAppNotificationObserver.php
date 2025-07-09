<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationObserverTrait;

class InAppNotificationObserver extends BaseModuleObserver
{
    use InAppNotificationObserverTrait;
}
