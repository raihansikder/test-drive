<?php

namespace App\Mainframe\Modules\InAppNotifications;

use App\Mainframe\Modules\InAppNotifications\Traits\InAppNotificationViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class InAppNotificationViewProcessor extends BaseModuleViewProcessor
{
    use InAppNotificationViewProcessorTrait;
}
