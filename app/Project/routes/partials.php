<?php

use App\Project\Http\Controllers\Partials\PartialsController;

/*----------------------------------------------------------------
| Section: Routes for server rendered partials
|-----------------------------------------------------------------
| These routes generate HTML for injecting into existing page using JS/Ajax
| https://laracasts.com/series/andrews-larabits/episodes/2
|---------------------------------------------------------------*/

Route::prefix('partials')->middleware(['request.json', 'auth', 'tenant'])->group(function () {
    Route::get('test', [PartialsController::class, 'test'])->name('partial.test'); // Todo: Remove this Example

    # Dynamic modals or adding elements
    Route::get('district-add-modal', [PartialsController::class, 'districtAddModal'])->name('partials.district-add-modal');
    Route::get('upazila-add-modal', [PartialsController::class, 'upazilaAddModal'])->name('partials.upazila-add-modal'); //
});
