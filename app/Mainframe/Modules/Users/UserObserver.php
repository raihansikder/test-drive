<?php

namespace App\Mainframe\Modules\Users;

use App\Mainframe\Modules\Users\Traits\UserObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class UserObserver extends BaseModuleObserver
{
    use UserObserverTrait;
}
