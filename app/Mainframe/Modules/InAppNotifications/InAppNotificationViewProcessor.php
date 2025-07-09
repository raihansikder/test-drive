<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationViewProcessorTrait;

class InAppNotificationViewProcessor extends BaseModuleViewProcessor
{
    use InAppNotificationViewProcessorTrait;
}
