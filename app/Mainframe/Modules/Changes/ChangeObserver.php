<?php

namespace App\Mainframe\Modules\Changes;

use App\Mainframe\Modules\Changes\Traits\ChangeObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class ChangeObserver extends BaseModuleObserver
{
    use ChangeObserverTrait;
}
