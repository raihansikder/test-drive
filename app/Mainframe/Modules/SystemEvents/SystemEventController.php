<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Mainframe\Modules\SystemEvents\Traits\SystemEventControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class SystemEventController extends ModularController
{
    use SystemEventControllerTrait;
}
