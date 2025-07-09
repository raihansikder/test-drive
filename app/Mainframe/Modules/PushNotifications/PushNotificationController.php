<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Project\Features\Modular\ModularController\ModularController;
use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationControllerTrait;

class PushNotificationController extends ModularController
{
    use PushNotificationControllerTrait;
}
