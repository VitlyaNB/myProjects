<?php

use App\Http\Controllers\Interests\DestroyController;
use App\Http\Controllers\Interests\ListController;
use App\Http\Controllers\Interests\StatsController;
use App\Http\Controllers\Interests\StoreController;
use App\Http\Controllers\Interests\UpdateController;

Route::get('/', ListController::class);
Route::post('/', StoreController::class);
Route::get('/stats', StatsController::class);
Route::put('/{interest}', UpdateController::class);
Route::delete('/{interest}', DestroyController::class);
