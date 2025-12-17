<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class PushNotificationProcessor extends ModelProcessor
{
    use PushNotificationProcessorTrait;
}
