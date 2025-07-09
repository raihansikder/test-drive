<?php

namespace App\Mainframe\Modules\Contents;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\Contents\Traits\ContentObserverTrait;

class ContentObserver extends BaseModuleObserver
{
    use ContentObserverTrait;
}
