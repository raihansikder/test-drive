<?php

namespace App\Mainframe\Commands;

use File;
use Illuminate\Support\Str;
use App\Mainframe\Helpers\Mf;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;


/**
 * Command to create a new Mainframe module with all necessary files and structure.
 * Generates models, controllers, views, migrations and other required module components.
 */
class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     * Example:
     * {command} php artisan mainframe:make-module {Name}
     * {command} php artisan mainframe:make-module \App\Project\Modules\{Name}
     * {command} php artisan mainframe:make-module \App\Mainframe\Modules\{Name}
     *
     * @var string
     */
    protected $signature = 'mainframe:make-module {namespace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a mainframe module';

    /**
     * Namespace of the module
     *
     * Example: \App\Project\Modules\SuperHeroes
     *
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $model;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->namespace = $this->setNamespace($this->argument('namespace'));
        $this->model = $this->model();
        $this->info($this->model.' Creating ..');
        $this->createClasses();  // Create the classes for the module, e.g., Model, Controller Observer, etc.
        $this->createViewFiles(); // Create view blades for the new module
        $this->createMigration(); // Create database migration for the new module
        $this->info($this->model.' ... Done');
    }

    /**
     * Set namespace
     * Example: \App\Project\Modules\SuperHeroes
     *
     * @param $str
     * @return string
     */
    public function setNamespace($str)
    {
        if (Str::contains($str, '\App\\')) {
            return $str;
        }

        return '\\'.projectNamespace().'\Modules'.Str::start(Str::studly($str), '\\');
    }

    /**
     * Check if the namespace is a mainframe module
     *
     * @return bool
     */
    public function isMainframeModule()
    {
        return Str::contains($this->namespace, 'Mainframe');
    }

    /**
     * Return project name. If project is not set, then extract from namespace.
     *
     * @return mixed|string
     */
    public function project()
    {
        return Mf::project() ?? $this->extractProjectNameFromNamespace();
    }

    /**
     *
     * @return string
     */
    public function projectViewDirName()
    {
        return Mf::projectResources();
    }

    /**
     * Extract Project name from the namespace
     * Example: For namespace "App\Projects\MyProject\..." returns "MyProject"
     *
     * @return mixed|string The project name
     */
    public function extractProjectNameFromNamespace()
    {
        return explode('\\', Str::after($this->namespace, 'Projects\\'))[0];
    }

    /**
     * Create database migration for the new module
     */
    public function createMigration()
    {
        // Get template code and run find-replace
        $code = $this->replace(File::get('app/Mainframe/Features/Modular/Skeleton/migration.php.stub'));

        // Create a new laravel migration
        $this->call('make:migration', ['name' => "create_{$this->moduleTable()}_table"]);

        // Find the newly created migration file and put the updated code.
        $migration = Collection::make(File::files('database/migrations'))->last();
        File::put($migration, $code);


        $this->info('... Migration created'); // Console output
    }

    /**
     * Create the classes for the module, e.g., Model, Controller Observer, etc.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createClasses()
    {
        $fromDir = 'app/Mainframe/Features/Modular/Skeleton/';

        // All the newly created files have the prefix "SuperHero". New files will be created
        // by adding {base}.php, {base}Policy.php, {base}Observer.php, etc.

        $toBase = $this->classDirectory().'/'.$this->modelClassBaseName();
        $toBase = str_replace('\\', '/', $toBase); // app/Project/Modules/Module/SuperHeroes/SuperHero

        $maps = [
            $fromDir.'SuperHero.php.stub' => $toBase.'.php',
            $fromDir.'SuperHeroResource.php.stub' => $toBase.'Resource.php',
            $fromDir.'SuperHeroCollection.php.stub' => $toBase.'Collection.php',
            $fromDir.'SuperHeroController.php.stub' => $toBase.'Controller.php',
            $fromDir.'SuperHeroDatatable.php.stub' => $toBase.'Datatable.php',
            $fromDir.'SuperHeroReport.php.stub' => $toBase.'Report.php',
            $fromDir.'SuperHeroList.php.stub' => $toBase.'List.php',
            $fromDir.'SuperHeroHelper.php.stub' => $toBase.'Helper.php',
            $fromDir.'SuperHeroScope.php.stub' => $toBase.'Scope.php',
            $fromDir.'SuperHeroObserver.php.stub' => $toBase.'Observer.php',
            $fromDir.'SuperHeroPolicy.php.stub' => $toBase.'Policy.php',
            $fromDir.'SuperHeroProcessor.php.stub' => $toBase.'Processor.php',
            $fromDir.'SuperHeroProcessorHelper.php.stub' => $toBase.'ProcessorHelper.php',
            $fromDir.'SuperHeroViewProcessor.php.stub' => $toBase.'ViewProcessor.php',
        ];

        // Create the directory if it does not exist.
        $this->info($this->classDirectory().'... Creating directory');
        File::makeDirectory($this->classDirectory(), 755, true);
        $this->info('... Done');

        // Create the files.
        $this->info('Creating Classes');
        foreach ($maps as $from => $to) {
            $this->info($to);
            $code = $this->replace(File::get($from)); // Run find-replace in boilerplate code
            File::put($to, $code);
        }
    }

    /**
     * Create view blades for the new module
     */
    public function createViewFiles()
    {
        $fromDir = 'app/Mainframe/Features/Modular/Skeleton/views'; // Source directory
        $toDir = 'resources/views/'.str_replace('.', '/', $this->viewDirectory()); // New module directory

        File::copyDirectory($fromDir, $toDir);

        $maps = [
            $fromDir.'/form/default.blade.php' => $toDir.'/form/default.blade.php',
            $fromDir.'/form/js.blade.php' => $toDir.'/form/js.blade.php',
            $fromDir.'/grid/default.blade.php' => $toDir.'/grid/default.blade.php',
        ];

        $this->info('Creating views');
        foreach ($maps as $from => $to) {
            $this->info($to);
            $code = $this->replace(File::get($from));
            File::put($to, $code);
        }
    }

    /**
     * Function to replace boilerplate code with new module name references
     *
     * @param $code
     * @return mixed
     */
    public function replace($code)
    {
        // replace maps
        $replaces = [
            'App\Mainframe\Modules\SuperHeroes' => trim($this->namespace, '\\'),
            'mainframe.modules.super-heroes' => $this->viewDirectory(),
            'super_heroes' => $this->moduleTable(),
            'super-heroes' => $this->routePath(),
            'SuperHeroes' => Str::plural($this->modelClassBaseName()),
            'SuperHero' => $this->modelClassBaseName(),
            'superHeroes' => lcfirst(Str::plural($this->modelClassBaseName())),
            'superHero' => lcfirst($this->modelClassBaseName()),
            '{table}' => $this->moduleTable(),
            '{module_name}' => $this->moduleName(),
            '{route_path}' => $this->routePath(),
            '{route_name}' => $this->routeName(),
            '{class_directory}' => $this->classDirectory(),
            '{namespace}' => $this->namespace,
            '{model}' => $this->model,
            '{policy}' => $this->policy(),
            '{processor}' => $this->processor(),
            '{controller}' => $this->controller(),
            '{view_directory}' => $this->viewDirectory(),
        ];

        if (!$this->isMainframeModule()) {
            $replaces = array_merge($replaces, [
                'App\Mainframe\Features' => trim(Mf::projectNamespace().'\Features', '\\'),
                '{project-name}' => $this->projectViewDirName(),
            ]);
        } else {
            $replaces = array_merge($replaces, [
                '{project-name}' => 'mainframe',
            ]);
        }

        // run replace across the boilerplate code
        foreach ($replaces as $k => $v) {
            $code = str_replace($k, $v, $code);
        }

        return $code;
    }

    /**
     * Get the model class name with namespace
     * Example: \App\Project\Modules\SuperHeroes\SuperHeroes
     *
     * @return string
     */
    public function model()
    {
        $modelClass = Str::singular(class_basename($this->namespace));

        return $this->namespace.'\\'.$modelClass;
    }

    /**
     * @return string super_heroes
     */
    /**
     * Get the database table name for the module
     * Example: For model SuperHero returns "super_heroes"
     *
     * @return string The snake_case plural form of model name
     */
    private function moduleTable()
    {
        return Str::snake(Str::plural($this->modelClassBaseName()));
    }

    /**
     * @return string super-heroes
     */
    /**
     * Get the module name in kebab case
     * Example: For model SuperHero returns "super-heroes"
     *
     * @return string The kebab-case plural form of model name
     */
    private function moduleName()
    {
        return Str::kebab(Str::plural($this->modelClassBaseName()));
    }

    /**
     * @return string super-heroes
     */
    /**
     * Get the route path for the module
     * Example: For model SuperHero returns "super-heroes"
     *
     * @return string The kebab-case plural form of model name
     */
    private function routePath()
    {
        return $this->moduleName();
    }

    /**
     * @return string super-heroes
     */
    /**
     * Get the route name for the module
     * Example: For model SuperHero returns "super-heroes"
     *
     * @return string The kebab-case plural form of model name
     */
    private function routeName()
    {
        return $this->moduleName();
    }

    /**
     * @return string app\Project\SuperHeroes
     */
    /**
     * Get the directory path where module classes will be created
     * Example: For namespace "App\Project\SuperHeroes" returns "app/Project/SuperHeroes"
     *
     * @return string The directory path
     */
    private function classDirectory()
    {
        $str = str_replace(
            ['\\App\\', '\\'],
            ['app/', '/'],
            $this->namespace
        );

        return trim($str, '\\/');
    }


    /**
     * Get the fully qualified class name for the module's policy
     *
     * @return string The policy class name with namespace
     */
    private function policy()
    {
        return $this->namespace.'\\'.$this->modelClassBaseName().'Policy';
    }

    /**
     * Get the fully qualified class name for the module's processor
     *
     * @return string The processor class name with namespace
     */
    private function processor()
    {
        return $this->namespace.'\\'.$this->modelClassBaseName().'Processor';
    }

    /**
     * Get the fully qualified class name for the module's controller
     *
     * @return string The controller class name with namespace
     */
    private function controller()
    {
        return $this->namespace.'\\'.$this->modelClassBaseName().'Controller';
    }

    /**
     * Get dot(.) separated location of the resource directory
     *
     * @return string
     */
    private function viewDirectory()
    {
        if ($resource = config('mainframe.config.project_resource')) {
            return $resource.'.modules.'.Str::kebab($this->modelClassBaseName());
        }

        $str = str_replace('\\App\\', '\\', $this->namespace); // \Project\Modules\SuperHeroes
        $directories = explode('\\', $str); // ['Project','Modules','SuperHeroes']

        $arr = [];
        foreach ($directories as $directory) {
            $arr[] = Str::kebab($directory); // ['project','modules','super-heroes']
        }

        $path = implode('.', $arr); // project.modules.super-heroes
        $path = trim($path, '.');  // project.modules.super-heroes

        return $path; // project
    }

    /**
     * @return string
     */
    /**
     * Get the base class name of the model without the namespace
     *
     * @return string The model class name
     */
    private function modelClassBaseName()
    {
        return class_basename($this->model);
    }

}
