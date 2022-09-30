<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function () {
    Route::get('/', function () {
        return redirect()->route('reseller.dashboard');
    });
    
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginView'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate']);
    });
});
