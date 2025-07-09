<?php

namespace App\Mainframe\Modules\Notifications;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\Notifications\Traits\NotificationViewProcessorTrait;

class NotificationViewProcessor extends BaseModuleViewProcessor
{
    use NotificationViewProcessorTrait;
}
