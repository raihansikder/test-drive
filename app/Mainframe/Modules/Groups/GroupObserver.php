<?php

namespace App\Mainframe\Modules\Groups;

use App\Mainframe\Modules\Groups\Traits\GroupObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class GroupObserver extends BaseModuleObserver
{
    use GroupObserverTrait;
}
