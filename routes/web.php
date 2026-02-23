<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Interests;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth as AuthControllers;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
        return redirect()->route('interests.index');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', AuthControllers\ShowLoginFormController::class)->name('login');
    Route::post('login', AuthControllers\ProcessLoginController::class);
    Route::get('register', AuthControllers\ShowRegistrationFormController::class)->name('register');
    Route::post('register', AuthControllers\ProcessRegistrationController::class);
    Route::get('password/reset', AuthControllers\ShowForgotPasswordFormController::class)->name('password.request');
    Route::post('password/email', AuthControllers\SendPasswordResetLinkController::class)->name('password.email');
    Route::get('password/reset/{token}', AuthControllers\ShowResetPasswordFormController::class)->name('password.reset');
    Route::post('password/reset', AuthControllers\ProcessResetPasswordController::class)->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', AuthControllers\LogoutController::class)->name('logout');
});

Route::middleware('auth')->prefix('interests')->group(function () {
    Route::get('/', interests\IndexController::class)->name('interests.index');
    Route::post('/', interests\StoreController::class)->name('interests.store');
    Route::get('/list', Interests\ListController::class)->name('interests.list');
    Route::get('/stats', Interests\StatsController::class)->name('interests.stats');
    Route::put('/{interest}', Interests\UpdateController::class)->name('interests.update');
    Route::delete('/{interest}', Interests\DestroyController::class)->name('interests.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Admin\DashboardController::class)->name('index');
    Route::get('/user/{user}/interests', Admin\UserInterestsController::class)->name('user.interests');
});
