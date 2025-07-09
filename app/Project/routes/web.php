<?php

use App\Project\Modules\Users\UserController;
use App\Project\Modules\Emails\EmailController;
use App\Project\Http\Controllers\HomeController;
use App\Project\Http\Controllers\ReportController;
use App\Project\Http\Controllers\DataBlockController;
use App\Project\Http\Controllers\DatatableController;

// Route::get('/', [HomeController::class, 'index'])->name('home'); // Code: Enabling this takes root url to a public page

Route::middleware(['auth', 'verified', 'tenant'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home'); // Code: Enable this takes root url to login page
    Route::get('data/{key}', [DataBlockController::class, 'show'])->name('data-block.show');
    Route::get('report/{key}', [ReportController::class, 'show'])->name('report');
    Route::get('datatable/{key}', [DatatableController::class, 'show'])->name('datatable.json');
    /*---------------------------------
    | Project specific routs
    |---------------------------------*/
    // Todo : Write new routes for your project

    /*---------------------------------
    | Section: Email routes
    |---------------------------------*/
    Route::post('emails/{email}/send-now', [EmailController::class, 'sendNow'])->name('emails.send-now');
    Route::post('emails/{email}/queue', [EmailController::class, 'queue'])->name('emails.queue');
    Route::get('emails/{email}/preview', [EmailController::class, 'preview'])->name('emails.preview');

    // Route::get('user-details/{id}', [HomeController::class, 'userDetails']);
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
});

/*---------------------------------
| Public routes
|---------------------------------*/
// Todo : Write any public routes for your project
Route::prefix('public')->group(function () {
    Route::get('/', [HomeController::class, 'public']);
});
