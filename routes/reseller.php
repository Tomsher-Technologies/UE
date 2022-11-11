<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\HubEz\HubEzController;
use App\Http\Controllers\Reseller\Auth\ResellerLoginController;
use App\Http\Controllers\Reseller\BookingController;
use App\Http\Controllers\Reseller\ResellerDashboardController;
use App\Http\Controllers\Reseller\SearchController;
use App\Http\Livewire\Reseller\Agent\AgentCreate;
use App\Http\Livewire\Reseller\Agent\AgentEdit;
use App\Http\Livewire\Reseller\Agent\AgentIndex;
use App\Http\Livewire\Reseller\Agent\AgentShow;
use App\Http\Livewire\Reseller\Users\UserCreate;
use App\Http\Livewire\Reseller\Users\UserEdit;
use App\Http\Livewire\Reseller\Users\UserIndex;
use App\Models\Common\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function () {
    Route::get('/', function () {
        // $count = 3;
        // $pyramid = array();

        // $car_count = $count * 2 - 1;

        // for ($i = 1; $i <= $count; $i++) {
        //     $pat = "";
        //     for ($c = 0; $c < $car_count; $c++) {
        //     }
        //     $pyramid[$i - 1] = $pat;
        // }

        // // [
        // //     "  *  ", 1, 5 = 3,3
        // //     " *** ", 2, 5 = 2,4
        // //     "*****" 3, 5 = 1,6
        // //   ]

        // print_r($pyramid);
        // return redirect()->route('reseller.dashboard');
    });

    Route::get('/hub',[HubEzController::class,'placeOrder']);

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [ResellerLoginController::class, 'loginView'])->name('login');
        Route::post('login', [ResellerLoginController::class, 'authenticate']);

        Route::get('register', [ResellerLoginController::class, 'registerView'])->name('register');
        Route::post('register', [ResellerLoginController::class, 'register']);
    });

    Route::middleware(['auth', 'auth.session', 'reseller'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [ResellerDashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'search', 'as' => 'search.'], function () {
            Route::get('/', [SearchController::class, 'searchView'])->name('search');
            Route::post('/', [SearchController::class, 'searchNew']);

            Route::post('/special-request', [SearchController::class, 'specialRequest'])->name('specialRequest');

            Route::get('/book', [BookingController::class, 'bookingView'])->name('booking');
            Route::post('/book', [BookingController::class, 'booking']);

            Route::get('/history', [SearchController::class, 'searchHistory'])->name('history');
            Route::post('/history/items', [SearchController::class, 'searchHistoryItems'])->name('history.items');
        });

        Route::group(['prefix' => 'agents', 'as' => 'agents.'], function () {
            Route::get('/', AgentIndex::class)->name('index');
            Route::get('/create', AgentCreate::class)->name('create');
            Route::get('/{user}/edit', AgentEdit::class)->name('edit');
            Route::get('/{user}/show', AgentShow::class)->name('show');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', UserIndex::class)->name('index');
            Route::get('/create', UserCreate::class)->name('create');
            Route::get('/{user}/edit', UserEdit::class)->name('edit');
        });

        include 'profile.php';
    });
});
