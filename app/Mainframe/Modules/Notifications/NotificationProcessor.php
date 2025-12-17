<?php

namespace App\Mainframe\Modules\Notifications;

use App\Mainframe\Modules\Notifications\Traits\NotificationProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class NotificationProcessor extends ModelProcessor
{
    use NotificationProcessorTrait;
}
