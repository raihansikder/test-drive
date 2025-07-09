<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\SystemEvents\Traits\SystemEventObserverTrait;

class SystemEventObserver extends BaseModuleObserver
{
    use SystemEventObserverTrait;
}
