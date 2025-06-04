<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\NotificationController;

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

Route::middleware('auth:api')->group(function () {
    // User notifications
    Route::get('/notifications', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'index']);
    Route::get('/notifications/unread', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'unread']);
    Route::get('/notifications/count', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'count']);
    Route::post('/notifications/{id}/mark-as-read', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'markAsRead']);
    Route::delete('/notifications/{id}', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'destroy']);
    
    // User notification preferences
    Route::get('/notifications/preferences', [\Modules\Notification\Http\Controllers\Api\NotificationPreferenceController::class, 'index']);
    Route::post('/notifications/preferences', [\Modules\Notification\Http\Controllers\Api\NotificationPreferenceController::class, 'update']);
});
