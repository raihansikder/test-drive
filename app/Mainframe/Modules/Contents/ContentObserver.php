<?php

namespace App\Mainframe\Modules\Contents;

use App\Mainframe\Modules\Contents\Traits\ContentObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class ContentObserver extends BaseModuleObserver
{
    use ContentObserverTrait;
}
