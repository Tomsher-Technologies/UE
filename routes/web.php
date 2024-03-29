<?php

use App\Http\Controllers\Common\AjaxController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\User\ResetPassword;
use App\Models\Zones\Country;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, "index"])->name('home');


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::post('/countries', [AjaxController::class, 'getCountries'])->name('getCountries');
    Route::post('/cities', [AjaxController::class, 'getCities'])->name('getCities');
    Route::post('/pincode', [AjaxController::class, 'getPincode'])->name('getPincode');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/forgot-password', function () {
        return view('user.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [ResetPassword::class, 'sendLink'])->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [ResetPassword::class, 'reset'])->middleware('guest')->name('password.update');
});

require_once 'admin.php';
require_once 'reseller.php';
