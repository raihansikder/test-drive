<?php

namespace App\Project\Jobs;

use App\SystemEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobStoreSystemEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $systemEvent;

    /**
     * @param  SystemEvent  $systemEvent
     */
    public function __construct(SystemEvent $systemEvent)
    {
        $this->systemEvent = $systemEvent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->systemEvent->process()->save();
    }

}
