<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class SubscriptionObserver extends BaseModuleObserver
{
    use SubscriptionObserverTrait;
}
