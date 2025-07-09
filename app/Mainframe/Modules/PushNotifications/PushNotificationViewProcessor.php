<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationViewProcessorTrait;

class PushNotificationViewProcessor extends BaseModuleViewProcessor
{
    use PushNotificationViewProcessorTrait;
}
