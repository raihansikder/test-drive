<?php

namespace App\Project\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace;  // 'App\Project\Http\Controllers';

    // protected $webRoutes = [
    //     'app/Project/routes/auth.php',
    //     'app/Project/routes/web.php',
    // ];

    protected $webRoutes = [];

    protected $apiRoutes = [];

    public function __construct($app)
    {
        parent::__construct($app);

        //$this->namespace = projectNamespace().'\Http\Controllers'; //App\Project\Http\Controllers

        $dir = projectDir().'/routes'; // app/Project/routes
        /*---------------------------------
        | Web routes
        |---------------------------------*/
        $routes = [
            'auth.php',
            'web.php',
            'modules.php',
            'partials.php',
            'services.php',
            'superuser.php',
            'test.php',
            // Add additional web routes here
        ];

        foreach ($routes as $route) {
            $this->webRoutes[] = $dir.'/'.$route;
        }

        /*---------------------------------
        | Api routes
        |---------------------------------*/
        $routes = [
            'api.php',
            // Add additional api routes here
        ];

        foreach ($routes as $route) {
            $this->apiRoutes[] = $dir.'/'.$route;
        }

    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        foreach ($this->webRoutes as $route) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }

    /**
     * Define the "api" routes for the application.
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        foreach ($this->apiRoutes as $route) {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }
}
