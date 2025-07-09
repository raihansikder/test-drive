<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionProcessorTrait;

class SubscriptionProcessor extends ModelProcessor
{
    use SubscriptionProcessorTrait;
}
