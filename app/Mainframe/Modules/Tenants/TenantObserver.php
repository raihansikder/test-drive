<?php

namespace App\Mainframe\Modules\Tenants;

use App\Mainframe\Modules\Tenants\Traits\TenantObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class TenantObserver extends BaseModuleObserver
{
    use TenantObserverTrait;
}
