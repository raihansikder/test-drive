<?php

namespace App\Mainframe\Modules\Packages;

use App\Mainframe\Modules\Packages\Traits\PackageObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class PackageObserver extends BaseModuleObserver
{
    use PackageObserverTrait;
}
