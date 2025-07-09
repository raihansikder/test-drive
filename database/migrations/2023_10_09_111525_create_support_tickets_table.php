<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateSupportTicketsTable extends Migration
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
        if (!Schema::hasTable('support_tickets')) {

            Schema::create('support_tickets', function (Blueprint $table) {

                /******* Default framework fields **********/
                $table->bigIncrements('id');
                $table->string('uuid', 64)->nullable()->default(null)->index();
                $table->unsignedInteger('project_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_id')->nullable()->default(null)->index();
                $table->text('name')->nullable()->default(null)->index();
                $table->text('name_ext')->nullable()->default(null)->index();

                /******* Custom columns **********/
                $table->unsignedInteger('division_id')->nullable()->default(null)->index();
                $table->text('division_name')->nullable()->default(null)->index();
                $table->unsignedInteger('district_id')->nullable()->default(null)->index();
                $table->text('district_name')->nullable()->default(null)->index();
                $table->unsignedInteger('upazila_id')->nullable()->default(null)->index();
                $table->text('upazila_name')->nullable()->default(null)->index();
                $table->unsignedInteger('user_id')->nullable()->default(null)->index();
                $table->text('details')->nullable()->default(null);
                $table->string('contact_no', 100)->nullable()->default(null);

                $table->unsignedInteger('primary_category_id')->nullable()->default(null)->index();
                $table->text('primary_category_name')->nullable()->default(null);
                $table->unsignedInteger('secondary_category_id')->nullable()->default(null)->index();
                $table->text('secondary_category_name')->nullable()->default(null);
                $table->text('support_ticket_tag_ids')->nullable()->default(null);
                $table->text('support_ticket_tag_names')->nullable()->default(null);
                $table->text('support_ticket_tag_names_formatted')->nullable()->default(null);

                $table->string('status_name', 100)->nullable()->default(null)->index();
                $table->text('reviewers_note')->nullable()->default(null);
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
        $name = 'support-tickets';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));  //Todo: Give a human friendly name
        $module->module_group_id = 1;                                           //Todo
        $module->order = 99;                                                    //Todo
        $module->level = 0;                                                     //Todo
        $module->description = 'Manage '.Str::plural($module->title);           //Todo
        $module->module_table = 'support_tickets';
        $module->route_path = 'support-tickets';
        $module->route_name = 'support-tickets';
        $module->default_route = 'support-tickets';
        $module->class_directory = 'app/Project/Modules/SupportTickets';
        $module->namespace = '\App\Project\Modules\SupportTickets';
        $module->model = '\App\Project\Modules\SupportTickets\SupportTicket';
        $module->policy = '\App\Project\Modules\SupportTickets\SupportTicketPolicy';
        $module->processor = '\App\Project\Modules\SupportTickets\SupportTicketProcessor';
        $module->controller = '\App\Project\Modules\SupportTickets\SupportTicketController';
        $module->view_directory = 'project.modules.support-tickets';
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
        Schema::dropIfExists('support_tickets');
    }
}
