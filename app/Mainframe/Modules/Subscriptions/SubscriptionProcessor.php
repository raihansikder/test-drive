<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SubscriptionProcessor extends ModelProcessor
{
    use SubscriptionProcessorTrait;
}
