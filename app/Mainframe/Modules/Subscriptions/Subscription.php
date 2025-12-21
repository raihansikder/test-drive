<?php

namespace App\Mainframe\Modules\Subscriptions;

use App\Mainframe\Modules\Subscriptions\Traits\SubscriptionTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Subscription extends BaseModule
{
    use SubscriptionTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'is_active',
    ];
}
