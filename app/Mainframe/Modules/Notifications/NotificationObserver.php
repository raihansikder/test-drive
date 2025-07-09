<?php

namespace App\Mainframe\Modules\Notifications;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\Notifications\Traits\NotificationObserverTrait;

class NotificationObserver extends BaseModuleObserver
{
    use NotificationObserverTrait;
}
