<?php

namespace App\Mainframe\Modules\Assignments;

use App\Mainframe\Modules\Assignments\Traits\AssignmentObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class AssignmentObserver extends BaseModuleObserver
{
    use AssignmentObserverTrait;
}
