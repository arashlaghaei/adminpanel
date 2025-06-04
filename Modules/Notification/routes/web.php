<?php

use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin/notifications')->middleware(['web'])->name('admin.notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('create', [NotificationController::class, 'test'])->name('test.form');
    Route::post('/test/send', [NotificationController::class, 'sendTest'])->name('test.send');
    Route::post('/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
    Route::post('/{id}/retry', [NotificationController::class, 'retry'])->name('retry');
    Route::get('/{id}', [NotificationController::class, 'show'])->name('show');
    Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
});

// User notification preferences routes
Route::prefix('notifications/preferences')->middleware(['web', 'auth'])->name('notifications.preferences.')->group(function () {
    Route::get('/', [\Modules\Notification\Http\Controllers\NotificationPreferenceController::class, 'index'])->name('index');
    Route::post('/update', [\Modules\Notification\Http\Controllers\NotificationPreferenceController::class, 'update'])->name('update');
});

// API routes for mobile app
Route::prefix('api/notifications')->middleware(['auth:api'])->name('api.notifications.')->group(function () {
    Route::get('/', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'index'])->name('index');
    Route::get('/unread', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'unread'])->name('unread');
    Route::post('/{id}/mark-as-read', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'markAsRead'])->name('mark-as-read');
    Route::delete('/{id}', [\Modules\Notification\Http\Controllers\Api\NotificationController::class, 'destroy'])->name('destroy');
});
