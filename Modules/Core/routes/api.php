<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\Api\Admin\UserController;
use Modules\Core\Http\Controllers\CoreController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('users', [UserController::class,'index'])->name('users.index');
        Route::get('users/{user}', [UserController::class,'show'])->name('users.show');
    });
//    Route::apiResource('core', CoreController::class)->names('core');
});
