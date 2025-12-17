<?php

namespace App\Mainframe\Modules\Notifications;

use App\Mainframe\Modules\Notifications\Traits\NotificationViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class NotificationViewProcessor extends BaseModuleViewProcessor
{
    use NotificationViewProcessorTrait;
}
