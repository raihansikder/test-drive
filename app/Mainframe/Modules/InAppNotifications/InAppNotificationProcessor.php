<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class InAppNotificationProcessor extends ModelProcessor
{
    use InAppNotificationProcessorTrait;
}
