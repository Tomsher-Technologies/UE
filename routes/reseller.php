<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Reseller\Auth\ResellerLoginController;
use App\Http\Controllers\Reseller\ResellerDashboardController;
use App\Http\Controllers\Reseller\SearchController;
use App\Http\Livewire\Reseller\Agent\AgentCreate;
use App\Http\Livewire\Reseller\Agent\AgentEdit;
use App\Http\Livewire\Reseller\Agent\AgentIndex;
use App\Http\Livewire\Reseller\Users\UserCreate;
use App\Http\Livewire\Reseller\Users\UserEdit;
use App\Http\Livewire\Reseller\Users\UserIndex;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function () {
    Route::get('/', function () {
        return redirect()->route('reseller.dashboard');
    });

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [ResellerLoginController::class, 'loginView'])->name('login');
        Route::post('login', [ResellerLoginController::class, 'authenticate']);

        Route::get('register', [ResellerLoginController::class, 'registerView'])->name('register');
        Route::post('register', [ResellerLoginController::class, 'register']);
    });

    Route::middleware(['auth', 'auth.session', 'reseller'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [ResellerDashboardController::class, 'index'])->name('dashboard');

        Route::post('/search', [SearchController::class, 'search'])->name('search');

        Route::group(['prefix' => 'agents', 'as' => 'agents.'], function () {
            Route::get('/', AgentIndex::class)->name('index');
            Route::get('/create', AgentCreate::class)->name('create');
            Route::get('/{user}/edit', AgentEdit::class)->name('edit');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', UserIndex::class)->name('index');
            Route::get('/create', UserCreate::class)->name('create');
            Route::get('/{user}/edit', UserEdit::class)->name('edit');
        });

        include 'profile.php';
    });
});
