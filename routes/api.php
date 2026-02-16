<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Interests\ListController;
use App\Http\Controllers\Interests\StoreController;
use App\Http\Controllers\Interests\UpdateController;
use App\Http\Controllers\Interests\DestroyController;
use App\Http\Controllers\Interests\StatsController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('interests')->group(function () {
        Route::get('/', ListController::class);
        Route::post('/', StoreController::class);
        Route::get('/stats', StatsController::class);
        Route::put('/{interest}', UpdateController::class);
        Route::delete('/{interest}', DestroyController::class);
    });
});
