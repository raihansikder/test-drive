<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    /*
    |--------------------------------------------------------------------------
    | Set up routes and middlewares
    |--------------------------------------------------------------------------
    |
    |
    */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            \Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class,
            \Illuminate\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

            # Added for mainframe.
            \Illuminate\Session\Middleware\StartSession::class, // Note : For mainframe this is moved from 'web' middlewareGroup
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Note : For mainframe this is moved from 'web' middlewareGroup
        ])->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // \Illuminate\Session\Middleware\StartSession::class, // Added in global
            // \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Added in global
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
        ])->alias([
            # Laravel default aliases https://laravel.com/docs/11.x/middleware#middleware-aliases
            # Mainframe middlewares
            'request.json' => \App\Mainframe\Http\Middleware\RequestJson::class,
            'superuser' => \App\Mainframe\Http\Middleware\AllowSuperuser::class,
            'bearer-token' => \App\Mainframe\Http\Middleware\VerifyBearerToken::class,
            'x-auth-token' => \App\Mainframe\Http\Middleware\VerifyXAuthToken::class,
            // Injecting tenant_id and facility_agency_id
            'tenant' => \App\Project\Http\Middleware\InjectTenant::class,
        ]);

    })
    /*
    |--------------------------------------------------------------------------
    | Load commands
    |--------------------------------------------------------------------------
    |
    |
    */
    ->withCommands([
        app_path('Mainframe/Commands'), // Load commands from directory
        app_path('Project/Commands'), // Load commands from directory
    ])
    /*
    |--------------------------------------------------------------------------
    | Define scheduled commands/jobs
    |--------------------------------------------------------------------------
    |
    |
    */
    ->withSchedule(function (Schedule $schedule) {
        # Hourly
        $schedule->command('telescope:prune')->hourly();
        $schedule->command('cache:clear')->hourly();

        # Daily
        $schedule->command('mainframe:clean-deleted-uploads')->daily();
        $schedule->command('mainframe:clean-temp')->daily();

        # Weekly
        $schedule->command('backup:run')->weekly()->environments(['production']);
    })
    /*
    |--------------------------------------------------------------------------
    | Exceptions
    |--------------------------------------------------------------------------
    |
    |
    */
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontFlash([
            'password',
            'password_confirmation',
        ]);
    })->create();
