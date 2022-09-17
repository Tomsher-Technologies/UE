<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('app.admin_prefix'), 'as' => 'admin.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginView'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate']);
    });
});

