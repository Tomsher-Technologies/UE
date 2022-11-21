<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\HubEz\HubEzController;
use App\Http\Controllers\Reseller\Auth\ResellerLoginController;
use App\Http\Controllers\Reseller\BookingController;
use App\Http\Controllers\Reseller\ResellerDashboardController;
use App\Http\Controllers\Reseller\SearchController;
use App\Http\Livewire\Reseller\Agent\AgentCreate;
use App\Http\Livewire\Reseller\Agent\AgentEdit;
use App\Http\Livewire\Reseller\Agent\AgentIndex;
use App\Http\Livewire\Reseller\Agent\AgentShow;
use App\Http\Livewire\Reseller\Agent\ProfitMargin;
use App\Http\Livewire\Reseller\Users\UserCreate;
use App\Http\Livewire\Reseller\Users\UserEdit;
use App\Http\Livewire\Reseller\Users\UserIndex;
use App\Models\Common\DynamicContents;
use App\Models\Common\Settings;
use App\Models\Integrators\Integrator;
use App\Models\Orders\Order;
use App\Models\Orders\Search;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function () {

    Route::get('/', function () {
        return redirect()->route('reseller.login');
    });

    Route::get('/hub', [HubEzController::class, 'placeOrder']);

    Route::get('/test', function () {

        $order = Order::find(5);
        $integrator = Integrator::find(1);
        $search = Search::with(['items', 'toCountry', 'fromCountry'])->find(1);

        return view('reseller.pages.order.success')->with([
            'integrator' => $integrator,
            'order' => $order,
            'search' => $search,
        ]);
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

        Route::group(['prefix' => 'search', 'as' => 'search.'], function () {
            Route::get('/', [SearchController::class, 'searchView'])->name('search');
            Route::post('/', [SearchController::class, 'searchNew']);

            Route::post('/special-request', [SearchController::class, 'specialRequest'])->name('specialRequest');

            Route::get('/search-history', [SearchController::class, 'searchHistory'])->name('history');
            Route::post('/search-history/items', [SearchController::class, 'searchHistoryItems'])->name('history.items');
        });

        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::get('/booking-history', [BookingController::class, 'bookingHistory'])->name('history');
            Route::get('/booking-history/{order}/details', [BookingController::class, 'bookingHistoryDetails'])->name('history.details');

            Route::post('/book', [BookingController::class, 'bookingView'])->name('view');
            Route::post('/book/submit', [BookingController::class, 'booking'])->name('submit');

            Route::get('/book', function () {
                return redirect()->route('reseller.dashboard');
            });
            Route::get('/book/submit', function () {
                return redirect()->route('reseller.dashboard');
            });
        });



        Route::group(['prefix' => 'agents', 'as' => 'agents.'], function () {
            Route::get('/', AgentIndex::class)->name('index');
            Route::get('/create', AgentCreate::class)->name('create');
            Route::get('/{user}/edit', AgentEdit::class)->name('edit');
            Route::get('/{user}/show', AgentShow::class)->name('show');

            Route::get('/profitMargin/{user}', ProfitMargin::class)->name('profitMargin');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', UserIndex::class)->name('index');
            Route::get('/create', UserCreate::class)->name('create');
            Route::get('/{user}/edit', UserEdit::class)->name('edit');
        });

        Route::get('/terms', function () {
            $terms = Cache::rememberForever('terms', function () {
                return DynamicContents::where('name', 'terms')->first();
            });

            return view('reseller.pages.others.terms')->with([
                'data' => $terms
            ]);
        })->name('terms');

        Route::get('/privacy', function () {
            $privacy = Cache::rememberForever('privacy', function () {
                return DynamicContents::where('name', 'privacyploicy')->first();
            });

            return view('reseller.pages.others.terms')->with([
                'data' => $privacy
            ]);
        })->name('privacy');

        include 'profile.php';
    });
});
