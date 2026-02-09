<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
        return redirect()->route('interests.index');
    }

    return redirect()->route('login');
});

// Роуты аутентификации
Auth::routes();

// Группа для обычных юзеров
Route::middleware('auth')->group(function () {
    Route::get('/interests', [InterestController::class, 'index'])->name('interests.index');
    Route::post('/interests', [InterestController::class, 'store'])->name('interests.store');
    Route::get('/interests/list', [InterestController::class, 'getList'])->name('interests.list');
    Route::get('/interests/stats', [InterestController::class, 'getStats'])->name('interests.stats');
    Route::put('/interests/{interest}', [InterestController::class, 'update'])->name('interests.update');
    Route::delete('/interests/{interest}', [InterestController::class, 'destroy'])->name('interests.destroy');
});

// Группа для Аадмина
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/user/{user}/interests', [AdminController::class, 'showUserInterests'])->name('user.interests');
});
