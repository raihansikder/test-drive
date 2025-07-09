<?php
/*----------------------------------------------------------------
| Section: Services routes
|-----------------------------------------------------------------
| https://laracasts.com/series/andrews-larabits/episodes/2
|---------------------------------------------------------------*/

use App\Mainframe\Modules\Users\UserController;

Route::prefix('partials')->middleware(['request.json', 'auth', 'tenant'])->group(function () {
    $namePrefix = 'service';

    // Example: Following will always return JSON output
    Route::get('users/{user}',
        [UserController::class, 'show'])->name($namePrefix.'.report.show');
});
