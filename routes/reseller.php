<?php

use App\Http\Controllers\Reseller\Auth\ResellerLoginController;
use App\Http\Controllers\Reseller\ResellerDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function () {
    Route::get('/', function () {
        return redirect()->route('reseller.dashboard');
    });

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [ResellerLoginController::class, 'loginView'])->name('login');
        Route::post('login', [ResellerLoginController::class, 'authenticate']);
    });

    Route::middleware(['auth', 'auth.session', 'reseller'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [ResellerDashboardController::class, 'index'])->name('dashboard');

        include 'profile.php';

    });
});
