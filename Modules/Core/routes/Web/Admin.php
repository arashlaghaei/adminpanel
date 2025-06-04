<?php

use Modules\Core\Http\Controllers\Admin\Role\RoleController;
use Modules\Core\Http\Controllers\Admin\User\ChangePasswordController;
use Modules\Core\Http\Controllers\Admin\User\ProfileController;
use Modules\Core\Http\Controllers\Admin\User\UserController;
use Modules\Core\Http\Controllers\CoreController;

Route::get('dashboard', [CoreController::class, 'dashboard'])->name('dashboard');


Route::group(['prefix' => 'user','as' => 'user.'], function () {

    Route::resource('user', UserController::class)->names('user');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('change-password', [ChangePasswordController::class, 'edit'])->name('changePassword.edit');
    Route::post('change-password', [ChangePasswordController::class, 'store'])->name('changePassword.store');
});



Route::group(['prefix' => 'role','as' => 'role.'], function () {

    Route::resource('role', RoleController::class)->names('role');

});

