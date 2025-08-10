<?php

namespace App\Mainframe\Commands;

use DB;
use App\Upload;

class CleanDeletedUploads extends MakeModule
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mainframe:clean-deleted-uploads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently remove deleted upload entries';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Deleting ..');

        Upload::withTrashed()->whereNotNull('deleted_at')->chunk(100, function ($uploads) {
            /** @var Upload $upload */
            foreach ($uploads as $upload) {
                $this->info("Deleting upload[{$upload->id}] ".$upload->absPath());
                Upload::deleteFilePath($upload->path);
            }
        });

        DB::table('uploads')->whereNotNull('deleted_at')->delete();

        $this->info('... Done');
    }

}
