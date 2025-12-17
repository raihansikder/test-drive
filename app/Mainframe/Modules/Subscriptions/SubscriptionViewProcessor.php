<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class SubscriptionViewProcessor extends BaseModuleViewProcessor
{
    use SubscriptionViewProcessorTrait;
}
