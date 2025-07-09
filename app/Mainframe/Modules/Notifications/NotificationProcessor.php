<?php

namespace App\Mainframe\Modules\Notifications;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Notifications\Traits\NotificationProcessorTrait;

class NotificationProcessor extends ModelProcessor
{
    use NotificationProcessorTrait;
}
