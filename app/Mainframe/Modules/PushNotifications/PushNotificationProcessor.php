<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationProcessorTrait;

class PushNotificationProcessor extends ModelProcessor
{
    use PushNotificationProcessorTrait;
}
