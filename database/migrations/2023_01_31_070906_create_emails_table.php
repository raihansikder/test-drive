<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*---------------------------------
        | Create the table if doesnt exists
        |---------------------------------*/
        if (!Schema::hasTable('emails')) {

            Schema::create('emails', function (Blueprint $table) {

                /******* Default framework fields **********/
                $table->bigIncrements('id');
                $table->string('uuid', 64)->nullable()->default(null)->index();
                $table->unsignedInteger('project_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_sl')->nullable()->default(null)->index();
                $table->string('name', 250)->nullable()->default(null)->index();
                $table->string('name_ext', 500)->nullable()->default(null)->index();
                $table->string('slug', 50)->nullable()->default(null)->index();

                /******* Custom columns **********/
                $table->text('to')->nullable()->default(null);
                $table->text('cc')->nullable()->default(null);
                $table->text('bcc')->nullable()->default(null);
                $table->string('subject')->nullable()->default(null);
                $table->text('html')->nullable()->default(null);

                $table->string('status_name')->nullable()->default(null)->index();
                $table->unsignedInteger('attempts')->nullable()->default(null);
                $table->dateTime('last_attempted_at')->nullable()->default(null);
                $table->dateTime('successfully_delivered_at')->nullable()->default(null);
                $table->unsignedInteger('to_user_id')->nullable()->default(null)->index();

                $table->unsignedInteger('module_id')->nullable()->default(null)->index();
                $table->unsignedInteger('element_id')->nullable()->default(null)->index();
                $table->string('emailable_type')->nullable()->default(null)->index();
                $table->unsignedBigInteger('emailable_id')->nullable()->default(null)->index();
                $table->text('attachments')->nullable()->default(null)->comment('JSON array of attachments');
                /*********************************/

                $table->tinyInteger('is_active')->nullable()->default(1);
                $table->unsignedInteger('created_by')->nullable()->default(null)->index();
                $table->unsignedInteger('updated_by')->nullable()->default(null)->index();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('deleted_by')->nullable()->default(null)->index();
            });
        }

        /*---------------------------------
        | Update modules table
        |---------------------------------*/
        $name = 'emails';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));  //Todo: Give a human friendly name
        $module->module_group_id = 1;                                           //Todo
        $module->order = 99;                                                    //Todo
        $module->level = 0;                                                     //Todo
        $module->description = 'Manage '.Str::plural($module->title);           //Todo
        $module->module_table = 'emails';
        $module->route_path = 'emails';
        $module->route_name = 'emails';
        $module->default_route = 'emails';
        $module->class_directory = 'app/Project\Modules\Emails';
        $module->namespace = '\\App\Project\Modules\Emails';
        $module->model = '\\App\Project\Modules\Emails\Email';
        $module->policy = '\\App\Project\Modules\Emails\EmailPolicy';
        $module->processor = '\\App\Project\Modules\Emails\EmailProcessor';
        $module->controller = '\\App\Project\Modules\Emails\EmailController';
        $module->view_directory = 'project.modules.emails';
        $module->icon_css = 'fa fa-cube';
        $module->color_css = 'navy';
        $module->is_visible = 1;
        $module->is_active = 1;
        $module->created_by = 1;

        $module->save();

        /*---------------------------------
        | Run following set of artisan commands
        |---------------------------------*/
        $output = new ConsoleOutput();
        $commands = [
            'cache:clear',
            'route:clear',
            'mainframe:create-root-models',
        ];
        foreach ($commands as $command) {
            $output->writeLn('php artisan '.$command);
            Artisan::call($command);
        }

        // if (config('app.env') == 'local') {
        //     Artisan::call('ide-helper:model -W');
        // }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
