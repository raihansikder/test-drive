<?php

namespace App\Project\Commands;

use Artisan;
use Illuminate\Console\Command;

class ClearTempTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clear-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will clear all mentioned temporary tables';

    /**
     * The number of days to retain data
     *
     * @var int
     */
    private $retain = 180;

    /**
     * The tables to clear
     *
     * @var array
     */
    private $tables = [
        'system_events',
        'in_app_notifications',
        'emails',
        'mqtt_messages',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->tables as $table) {
            $this->info("Clearing table:{$table} ...");
            Artisan::call("command:clear-table {$table} --retain={$this->retain}");
        }
    }

}
