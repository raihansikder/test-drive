<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class PushNotificationController extends ModularController
{
    use PushNotificationControllerTrait;
}
