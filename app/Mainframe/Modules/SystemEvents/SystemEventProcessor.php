<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Mainframe\Modules\SystemEvents\Traits\SystemEventProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SystemEventProcessor extends ModelProcessor
{
    use SystemEventProcessorTrait;
}
