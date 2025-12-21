<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class SubscriptionController extends ModularController
{
    use SubscriptionControllerTrait;
}
