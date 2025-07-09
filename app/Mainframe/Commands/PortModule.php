<?php

namespace App\Mainframe\Commands;

use Artisan;
use App\Module;
use Illuminate\Support\Str;
use App\Mainframe\Helpers\Mf;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class PortModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "mainframe:port-module 
                            {module_name : Input the module name i.e 'cart-items' or 'all' for all projects}
                            {--project= : Input the project name i.e. 'MyCustomProject'}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This updates the class paths in modules table of a given module to match the new project';

    /** @var string */
    private $moduleName;

    /** * @var string */
    private $projectName;

    /**
     * Execute the console command.
     *
     * @return mixed|null
     */
    public function handle()
    {
        $this->moduleName = Str::kebab(Str::plural($this->argument('module_name')));
        $this->projectName = ucfirst(Str::camel($this->option('project'))) ?: Mf::project();
        $this->info('Porting module:'.$this->moduleName.' to project -> \''.$this->projectName.'\'');
        /*---------------------------------
        | Update modules table
        |---------------------------------*/

        $query = Module::query();
        if ($this->moduleName != 'alls') {  // Since it is turned to plural anyway
            $query->where('name', $this->moduleName);
        }

        $output = new ConsoleOutput();

        $query->chunk(10, function ($modules) use ($output) {

            $projectDir = Mf::projectDir();
            $projectNamespace = Mf::projectNamespace();
            $projectResource = Mf::projectResources();

            foreach ($modules as $module) {
                $class = str_replace('-', '', Str::title(Str::singular($module->name))); // cart-items -> CartItem

                $module->class_directory = $projectDir.'/Modules/'.Str::plural($class);
                $module->namespace = $projectNamespace.'\Modules\\'.Str::plural($class);
                $module->model = $module->namespace.'\\'.$class;
                $module->policy = $module->namespace.'\\'.$class.'Policy';
                $module->processor = $module->namespace.'\\'.$class.'Processor';
                $module->controller = $module->namespace.'\\'.$class.'Controller';
                $module->view_directory = $projectResource.'.modules.'.$module->name;
                $module->saveQuietly();
                $output->writeLn('module '.$module->name.' .. done');
            }
        });

        $output->writeLn('php artisan cache:clear');
        Artisan::call('cache:clear');

        $output->writeLn('php artisan route:clear');
        Artisan::call('route:clear');

        // $output->writeLn('php artisan mainframe:create-root-models');
        // Artisan::call('mainframe:create-root-models');

        $this->info('... Done');
    }

}
