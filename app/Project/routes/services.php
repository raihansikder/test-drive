<?php

use App\Project\Http\Controllers\Services\ServicesController;

/*---------------------------------------------------------------------------------
| Section: Services routes
|----------------------------------------------------------------------------------
| Services routes are created to be used in your ajax calls. Inside your application.
| Often for vue or axios call you will need custom responses to best handle the situation
|---------------------------------------------------------------------------------*/

Route::middleware(['request.json', 'auth', 'tenant'])->prefix('service')->name('service.')->group(function () {
    Route::get('test', [ServicesController::class, 'test'])->name('test'); //service.test
});
