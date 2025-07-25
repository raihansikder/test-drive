<?php

namespace App\Mainframe\Modules\Projects;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\Projects\Traits\ProjectObserverTrait;

class ProjectObserver extends BaseModuleObserver
{
    use ProjectObserverTrait;
}
