<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class PushNotificationObserver extends BaseModuleObserver
{
    use PushNotificationObserverTrait;
}
