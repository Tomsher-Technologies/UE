<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Integrators\IntegratorController;
use App\Http\Controllers\Admin\UEUser\UEUserController;
use App\Http\Controllers\HubEz\HubEzController;
use App\Http\Controllers\UeUser\UeUserDashboard;
use App\Http\Controllers\User\LogoutController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => config('app.admin_prefix'), 'as' => 'admin.'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/test', [HubEzController::class, 'placeOrder']);

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginView'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate']);
    });

    Route::middleware(['auth', 'auth.session', 'admin'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


        Route::resource('ueusers', UEUserController::class)->parameters([
            'ueusers' => 'user'
        ])->only(['index', 'create', 'edit', 'show']);

        Route::resource('customer', CustomerController::class)->parameters([
            'customer' => 'user'
        ])->only(['index', 'create', 'edit', 'show']);

        Route::group(['prefix' => 'integrator', 'as' => 'integrator.'], function () {
            Route::get('/{integrator}/upload/rates', [IntegratorController::class, 'uploadRatesView'])->name('uploadRates');
            Route::post('/{integrator}/upload/rates', [IntegratorController::class, 'uploadRates']);

            Route::get('/{integrator}/upload/zones', [IntegratorController::class, 'uploadZoneView'])->name('uploadZones');
            Route::post('/{integrator}/upload/zones', [IntegratorController::class, 'uploadZone']);
        });
        Route::resource('integrator', IntegratorController::class)->only(['index', 'create', 'edit', 'show']);
        include 'profile.php';
    });


    // Route::middleware(['auth', 'auth.session', 'ueuser'])->group(function () {
    //     Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    //     Route::get('dashboard', [UeUserDashboard::class, 'index'])->name('dashboard');
    //     include 'profile.php';
    // });

});
