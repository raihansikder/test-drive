<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\SystemEvents\Traits\SystemEventProcessorTrait;

class SystemEventProcessor extends ModelProcessor
{
    use SystemEventProcessorTrait;
}
