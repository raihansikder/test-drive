<?php

namespace App\Mainframe\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;

class JobSyncData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var BaseModule */
    public $module;

    /** @var string */
    public $function;

    /**
     * Create a new job instance.
     *
     * @param  BaseModule  $module
     */
    public function __construct($module, $function = 'syncData')
    {
        $this->module = $module;
        $this->function = $function;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $this->module->syncData();
        /*---------------------------------
        | Execute a sync functions
        | The default function is syncData()
        |---------------------------------*/
        $this->module->{$this->function}();
    }
}
