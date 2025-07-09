<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionPolicyTrait;

class SubscriptionPolicy extends BaseModulePolicy
{
    use SubscriptionPolicyTrait;
}
