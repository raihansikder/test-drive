<?php

namespace App\Mainframe\Modules\Notifications;

use App\Mainframe\Modules\Notifications\Traits\NotificationControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class NotificationController extends ModularController
{
    use NotificationControllerTrait;
}
