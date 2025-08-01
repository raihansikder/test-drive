<?php

namespace App\Project\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // \Illuminate\Auth\Events\Verified::class => [
        //     App\Listeners\LogVerifiedUser::class,
        // ],
        // 'Illuminate\Auth\Events\Registered' => [
        //     //'App\Project\Listeners\Registered\Notify'
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
