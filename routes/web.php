<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('core.web.admin.dashboard');
    return view('admin.master');
});
