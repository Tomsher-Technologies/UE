<?php

use App\Http\Controllers\User\ProfileController;
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


Route::name('user.')->group(function () {
    Route::get('profile', [ProfileController::class, 'viewprofile'])->name('profile');
    Route::put('/password-update', [ProfileController::class, 'updatePassword'])->name('password-update');
    Route::put('/profile-update', [ProfileController::class, 'updateProfile'])->name('profile-update');
    Route::post('/logout-everywhere', [ProfileController::class, 'logoutEverywhere'])->name('logout-everywhere');
});