<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class SubscriptionPolicy extends BaseModulePolicy
{
    use SubscriptionPolicyTrait;
}
