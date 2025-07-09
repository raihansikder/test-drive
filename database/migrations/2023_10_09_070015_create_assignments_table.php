<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateAssignmentsTable extends Migration
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
        if (!Schema::hasTable('assignments')) {

            Schema::create('assignments', function (Blueprint $table) {

                /******* Default framework fields **********/
                $table->bigIncrements('id');
                $table->string('uuid', 64)->nullable()->default(null)->index();
                $table->unsignedInteger('project_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_id')->nullable()->default(null)->index();
                $table->string('name', 250)->nullable()->default(null)->index();

                /******* Custom columns **********/
                $table->string('type', 50)->nullable()->default(null)->index();
                $table->bigInteger('module_id')->nullable()->default(null)->index();
                $table->bigInteger('element_id')->nullable()->default(null)->index();
                $table->string('element_uuid', 64)->nullable()->default(null)->index();
                $table->string('assignable_type', 255)->nullable()->default(null)->index();
                $table->bigInteger('assignable_id')->nullable()->default(null)->index();
                $table->unsignedInteger('assignee_user_id')->nullable()->default(null)->index();
                $table->string('status', 100)->nullable()->default(null)->index();
                $table->text('note')->nullable()->default(null);

                /*********************************/
                $table->string('name_ext', 500)->nullable()->default(null)->index();
                $table->string('slug', 50)->nullable()->default(null)->index();
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
        $name = 'assignments';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));  //Todo: Give a human friendly name
        $module->module_group_id = 1;                                           //Todo
        $module->order = 99;                                                    //Todo
        $module->level = 0;                                                     //Todo
        $module->description = 'Manage '.Str::plural($module->title);           //Todo
        $module->module_table = 'assignments';
        $module->route_path = 'assignments';
        $module->route_name = 'assignments';
        $module->default_route = 'assignments';
        $module->class_directory = 'app/Project/Modules/Assignments';
        $module->namespace = '\App\Project\Modules\Assignments';
        $module->model = '\App\Project\Modules\Assignments\Assignment';
        $module->policy = '\App\Project\Modules\Assignments\AssignmentPolicy';
        $module->processor = '\App\Project\Modules\Assignments\AssignmentProcessor';
        $module->controller = '\App\Project\Modules\Assignments\AssignmentController';
        $module->view_directory = 'project.modules.assignments';
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
        Schema::dropIfExists('assignments');
    }
}
