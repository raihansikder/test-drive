<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateSupportTicketCategoriesTable extends Migration
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
        if (!Schema::hasTable('support_ticket_categories')) {

            Schema::create('support_ticket_categories', function (Blueprint $table) {

                /******* Default framework fields **********/
                $table->bigIncrements('id');
                $table->string('uuid', 64)->nullable()->default(null)->index();
                $table->unsignedInteger('project_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_id')->nullable()->default(null)->index();
                $table->string('name', 250)->nullable()->default(null)->index();
                $table->text('name_ext')->nullable()->default(null)->index();

                /******* Custom columns **********/
                $table->text('email_recipients')->nullable()->default(null);
                $table->unsignedInteger('parent_id')->nullable()->default(null);
                $table->text('parent_name')->nullable()->default(null);
                $table->text('upper_level_ids')->nullable()->default(null);
                $table->text('lower_level_ids')->nullable()->default(null);
                $table->text('parallel_level_ids')->nullable()->default(null);
                $table->unsignedInteger('order')->nullable()->default(null);
                $table->string('slug', 50)->nullable()->default(null);
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
        $name = 'support-ticket-categories';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));  //Todo: Give a human friendly name
        $module->module_group_id = 1;                                           //Todo
        $module->order = 99;                                                    //Todo
        $module->level = 0;                                                     //Todo
        $module->description = 'Manage '.Str::plural($module->title);           //Todo
        $module->module_table = 'support_ticket_categories';
        $module->route_path = 'support-ticket-categories';
        $module->route_name = 'support-ticket-categories';
        $module->default_route = 'support-ticket-categories';
        $module->class_directory = 'app/Project/Modules/SupportTicketCategories';
        $module->namespace = '\App\Project\Modules\SupportTicketCategories';
        $module->model = '\App\Project\Modules\SupportTicketCategories\SupportTicketCategory';
        $module->policy = '\App\Project\Modules\SupportTicketCategories\SupportTicketCategoryPolicy';
        $module->processor = '\App\Project\Modules\SupportTicketCategories\SupportTicketCategoryProcessor';
        $module->controller = '\App\Project\Modules\SupportTicketCategories\SupportTicketCategoryController';
        $module->view_directory = 'project.modules.support-ticket-categories';
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
        Schema::dropIfExists('support_ticket_categories');
    }
}
