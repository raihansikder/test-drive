<?php

/*
|--------------------------------------------------------------------------
| Mainframe web routes
|--------------------------------------------------------------------------
*/

use App\Mainframe\Http\Controllers\DataBlockController;
use App\Mainframe\Http\Controllers\DatatableController;
use App\Mainframe\Http\Controllers\HomeController;
use App\Mainframe\Http\Controllers\ReportController;

Route::middleware(['auth', 'verified', 'tenant'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home'); // Code: Enable this takes root url to login page
    Route::get('data/{key}', [DataBlockController::class, 'show'])->name('data-block.show');
    Route::get('report/{key}', [ReportController::class, 'show'])->name('report');
    Route::get('datatable/{key}', [DatatableController::class, 'show'])->name('datatable.json');
});
/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/
// Todo : Write any public routes for your project
