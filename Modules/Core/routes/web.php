<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\Admin\User\UserController;
use Modules\Core\Http\Controllers\CoreController;

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

Route::group(['as'=>'core.'], function () {
    Route::resource('core', CoreController::class)->names('core');

    Route::resource('user', UserController::class)->names('user');
});
