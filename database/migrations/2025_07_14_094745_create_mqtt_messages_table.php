<?php
/** @noinspection ClassConstantCanBeUsedInspection */

/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateMqttMessagesTable extends Migration
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
        if (!Schema::hasTable('mqtt_messages')) {
            Schema::create('mqtt_messages', function (Blueprint $table) {
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
                //  Add module specific fields and denormalized fields. In computing, denormalization is the process of
                //  improving the read performance of a database, at the expense of losing some write performance,
                //  by adding redundant copies of data or by grouping it.

                //$table->string('title', 100)->nullable()->default(null);
                //$table->text('field')->nullable()->default(null);
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
        $name = 'mqtt-messages';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));  // Give a human friendly name
        $module->module_group_id = 1; // Assign this module under an existing module-group
        $module->order = 99; // Assign an order for this module
        $module->level = 0;  // Assign a level.
        $module->description = 'Manage '.Str::plural($module->title); // Description of the module
        $module->module_table = 'mqtt_messages';
        $module->route_path = 'mqtt-messages';
        $module->route_name = 'mqtt-messages';
        $module->default_route = 'mqtt-messages';
        $module->class_directory = 'app/Project/Modules/MqttMessages';
        $module->namespace = '\\App\Project\Modules\MqttMessages';
        $module->model = '\\App\Project\Modules\MqttMessages\MqttMessage';
        $module->policy = '\\App\Project\Modules\MqttMessages\MqttMessagePolicy';
        $module->processor = '\\App\Project\Modules\MqttMessages\MqttMessageProcessor';
        $module->controller = '\\App\Project\Modules\MqttMessages\MqttMessageController';
        $module->view_directory = 'project.modules.mqtt-messages';
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

        DB::unprepared(File::get(database_path().'/scripts/mqtt_messages.sql')); // Load SQL
        DB::table('mqtt_messages')->truncate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mqtt_messages');
    }
}
