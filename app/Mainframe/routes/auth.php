<?php

use App\Mainframe\Http\Controllers\Auth\LoginController;
use App\Mainframe\Http\Controllers\Auth\RegisterController;
use App\Mainframe\Http\Controllers\Auth\VerificationController;
use App\Mainframe\Http\Controllers\Auth\ResetPasswordController;
use App\Mainframe\Http\Controllers\Auth\ForgotPasswordController;
use App\Mainframe\Http\Controllers\Auth\RegisterTenantController;
use App\Mainframe\Http\Controllers\Auth\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| Mainframe Auth routes
|--------------------------------------------------------------------------
|
| These routes are manually added instead of calling Auth::routes();
| This gives much flexibility to write these routes as necessary
| for the architectural implementation
|
*/

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', [LoginController::class, 'logout'])->name('get.logout'); // For Logout URL

// Registration Routes...
Route::get('register/{groupName?}', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register/{groupName?}', [RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Password Confirmation Routes...
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

// Email Verification Routes...
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

/*
|--------------------------------------------------------------------------
| Mainframe Tenant Registration routes
|--------------------------------------------------------------------------
|
*/
// Tenant Registration Routes...
Route::get('register-tenant', [RegisterTenantController::class, 'showRegistrationForm'])->name('register.tenant');
Route::post('register-tenant', [RegisterTenantController::class, 'register']);
