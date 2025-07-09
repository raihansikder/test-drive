<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationProcessorTrait;

class InAppNotificationProcessor extends ModelProcessor
{
    use InAppNotificationProcessorTrait;
}
