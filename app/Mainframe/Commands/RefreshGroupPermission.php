<?php

namespace App\Mainframe\Commands;

use App\Group;

class RefreshGroupPermission extends MakeModule
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mainframe:refresh-group-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads group permissions from config to database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $this->info('Loading group permissions from config to database...');

        Group::latest()->chunk(100, function ($groups) {
            /** @var Group $group */
            foreach ($groups as $group) {
                if ($group->refreshPermissionFromConfig()) {
                    $this->info($group->name.' ... Done');
                } else {
                    $this->info($group->name.' ... not found');
                }
            }
        });

    }
}
