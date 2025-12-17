<?php

namespace App\Mainframe\Modules\Notifications;

use App\Mainframe\Modules\Notifications\Traits\NotificationObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class NotificationObserver extends BaseModuleObserver
{
    use NotificationObserverTrait;
}
