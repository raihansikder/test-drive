<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateSystemEventsTable extends Migration
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
        if (!Schema::hasTable('system_events')) {

            Schema::create('system_events', function (Blueprint $table) {

                /******* Default framework fields **********/
                $table->bigIncrements('id');
                $table->string('uuid', 64)->nullable()->default(null)->index();
                $table->unsignedInteger('project_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_id')->nullable()->default(null)->index();
                $table->string('name', 250)->nullable()->default(null)->index();

                /******* Custom columns **********/
                $table->text('details')->nullable()->default(null);
                $table->string('provider', 50)->nullable()->default(null)->index();
                $table->string('source', 50)->nullable()->default(null)->index();
                $table->string('environment', 20)->nullable()->default(null)->index();
                $table->string('version', 10)->nullable()->default(null)->index();
                $table->string('type', 100)->nullable()->default(null)->index();
                $table->longText('content')->nullable()->default(null);

                $table->unsignedInteger('module_id')->nullable()->default(null);
                $table->unsignedInteger('element_id')->nullable()->default(null);
                $table->string('element_uuid', 64)->nullable()->default(null);

                $table->unsignedInteger('user_id')->nullable()->default(null);
                $table->timestamp('occurred_at')->nullable()->default(null);

                $table->text('tags')->nullable()->default(null);
                $table->string('url', 100)->nullable()->default(null);
                $table->string('ip_address', 100)->nullable()->default(null);
                $table->text('user_agent')->nullable()->default(null);

                $table->string('name_ext', 500)->nullable()->default(null)->index();
                $table->string('slug', 50)->nullable()->default(null)->index();
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
        $name = 'system-events';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));  //Todo: Give a human friendly name
        $module->module_group_id = 1;                                           //Todo
        $module->order = 99;                                                    //Todo
        $module->level = 0;                                                     //Todo
        $module->description = 'Manage '.Str::plural($module->title);           //Todo
        $module->module_table = 'system_events';
        $module->route_path = 'system-events';
        $module->route_name = 'system-events';
        $module->default_route = 'system-events';
        $module->class_directory = 'app/Project/Modules/SystemEvents';
        $module->namespace = '\App\Project\Modules\SystemEvents';
        $module->model = '\App\Project\Modules\SystemEvents\SystemEvent';
        $module->policy = '\App\Project\Modules\SystemEvents\SystemEventPolicy';
        $module->processor = '\App\Project\Modules\SystemEvents\SystemEventProcessor';
        $module->controller = '\App\Project\Modules\SystemEvents\SystemEventController';
        $module->view_directory = 'project.modules.system-events';
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
        Schema::dropIfExists('system_events');
    }
}
