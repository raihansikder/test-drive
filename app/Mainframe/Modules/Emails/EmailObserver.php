<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class EmailObserver extends BaseModuleObserver
{
    use EmailObserverTrait;
}
