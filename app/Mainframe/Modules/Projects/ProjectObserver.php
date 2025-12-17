<?php

namespace App\Mainframe\Modules\Projects;

use App\Mainframe\Modules\Projects\Traits\ProjectObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class ProjectObserver extends BaseModuleObserver
{
    use ProjectObserverTrait;
}
