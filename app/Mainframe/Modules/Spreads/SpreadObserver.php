<?php

namespace App\Mainframe\Modules\Spreads;

use App\Mainframe\Modules\Spreads\Traits\SpreadObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class SpreadObserver extends BaseModuleObserver
{
    use SpreadObserverTrait;
}
