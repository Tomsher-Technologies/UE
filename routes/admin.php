<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UEUser\UEUserController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => config('app.admin_prefix'), 'as' => 'admin.'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginView'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate']);
    });

    Route::resource('ueusers', UEUserController::class)->parameters([
        'ueusers' => 'user'
    ])->only(['index', 'create', 'edit', 'show']);

    Route::middleware(['auth', 'auth.session', 'admin'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        include 'profile.php';
    });
});
