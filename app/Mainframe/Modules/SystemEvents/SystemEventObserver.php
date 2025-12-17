<?php

namespace App\Mainframe\Modules\SystemEvents;

use App\Mainframe\Modules\SystemEvents\Traits\SystemEventObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class SystemEventObserver extends BaseModuleObserver
{
    use SystemEventObserverTrait;
}
