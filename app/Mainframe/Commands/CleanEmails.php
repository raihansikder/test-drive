<?php

namespace App\Mainframe\Commands;

use DB;

class CleanEmails extends MakeModule
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mainframe:clean-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete old entries of emails table that are two week old';

    /**
     * Execute the console command.
     *
     * @return mixed|null
     */
    public function handle()
    {

        $this->info('Deleting ..');

        DB::table('emails')
            ->where('created_at', '<=', now()->subWeeks(2))
            ->delete();

        $this->info('... Done');

    }

}
