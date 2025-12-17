<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Mainframe\Modules\SystemEvents\Traits\SystemEventViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class SystemEventViewProcessor extends BaseModuleViewProcessor
{
    use SystemEventViewProcessorTrait;
}
