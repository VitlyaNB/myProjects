<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Interests;
use App\Http\Controllers\Admin;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
        return redirect()->route('interests.index');
    }
    return redirect()->route('login');
});

Auth::routes();

// Группа для обычных юзеров
Route::middleware('auth')->group(function () {
    Route::get('/interests', Interests\IndexController::class)->name('interests.index');
    Route::post('/interests', Interests\StoreController::class)->name('interests.store');

    // API-like endpoints
    Route::get('/interests/list', Interests\ListController::class)->name('interests.list');
    Route::get('/interests/stats', Interests\StatsController::class)->name('interests.stats');

    Route::put('/interests/{interest}', Interests\UpdateController::class)->name('interests.update');
    Route::delete('/interests/{interest}', Interests\DestroyController::class)->name('interests.destroy');
});

// Группа для Админа
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Admin\DashboardController::class)->name('index');
    Route::get('/user/{user}/interests', Admin\UserInterestsController::class)->name('user.interests');
});
