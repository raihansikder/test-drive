<?php

namespace App\Mainframe\Providers;

use Illuminate\Support\MessageBag;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use App\Mainframe\Macros\QueryBuilderMacros;
use App\Mainframe\Features\Responder\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register commands.
     * \App\Console\Kernel::commands() already registers commands that are stored in
     * app/Commands, app/Mainframe/Commands, app/Project/Commands
     * @var array
     */
    protected $commands = [ // Note: keeping this for some older projects where the directory is not registered in kernel.php
        \App\Mainframe\Commands\MakeModule::Class,
        \App\Mainframe\Commands\PortModule::Class,
        \App\Mainframe\Commands\CreateRootModels::Class,
        \App\Mainframe\Commands\CleanDeletedUploads::Class,
        \App\Mainframe\Commands\FixPolymorphicType::class,
        \App\Mainframe\Commands\FixContentKey::class,
        \App\Mainframe\Commands\RefreshGroupPermission::class,
        \App\Mainframe\Commands\RefreshModules::class,
        \App\Mainframe\Commands\CleanTempDirectory::class,
        \App\Mainframe\Commands\CleanEmails::class,
    ];

    protected $providers = [
        AuthServiceProvider::class,
        EventServiceProvider::class,
        RouteServiceProvider::class,
        \OwenIt\Auditing\AuditingServiceProvider::class,
    ];

    protected $helpers = [
        'Mainframe/Helpers/functions.php',
        'Mainframe/Helpers/generic.php',
    ];

    /**
     * Register services, helpers etc.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHelpers();
        $this->registerProviders();
        $this->registerCommands();
        $this->registerSingletons();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        // Builder::macro('searchIn', function ($attributes, $needle) {
        //     return $this->where(function (Builder $query) use ($attributes, $needle) {
        //         foreach (\Arr:wrap($attributes) as $attribute) {
        //             $query->orWhere($attribute, 'LIKE', "%{$needle}%");
        //         }
        //     });
        // });

        Builder::mixin(new QueryBuilderMacros());
    }

    /**
     * Register commands
     */
    public function registerCommands()
    {
        $this->commands($this->commands);
    }

    /**
     * Include helpers
     */
    public function registerHelpers()
    {
        foreach ($this->helpers as $helper) {
            require_once app_path($helper);
        }

        // /*
        //  * Include all php files in a directory.
        //  */
        // foreach (glob(app_path('Helpers').'/*.php') as $file) {
        //     require_once $file;
        // }
    }

    /**
     * Register providers.
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

    }

    /**
     * Register singletons
     */
    public function registerSingletons()
    {

        $this->app->singleton(MessageBag::class, function () {
            return new MessageBag();
        });
        $this->app->singleton(Response::class, function () {
            return new Response();
        });
    }

}
