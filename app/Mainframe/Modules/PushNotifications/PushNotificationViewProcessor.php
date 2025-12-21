<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class PushNotificationViewProcessor extends BaseModuleViewProcessor
{
    use PushNotificationViewProcessorTrait;
}
