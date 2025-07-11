<?php

namespace App\Mainframe\Commands;

use DB;
use Illuminate\Console\Command;

class ClearTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clear-table {table} {--retain=180}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will delete entries from specific tables';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $table = $this->argument('table');
        $retain = (int) $this->option('retain');


        DB::table($table)
            ->where('updated_at', '<=', now()->subDays($retain))
            ->delete();

        $this->info("Deleted entries from table:{$table} that are older than {$retain} days");
    }

}
