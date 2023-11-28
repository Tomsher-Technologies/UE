<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Common\DynamicContentsController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Integrators\IntegratorController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\Surcharge\SurchargeController;
use App\Http\Controllers\Admin\UEUser\UEUserController;
use App\Http\Livewire\Admin\Booking\BookingHistory;
use App\Http\Livewire\Admin\Booking\BookingHistoryDetails;
use App\Http\Livewire\Admin\Customer\Grade;
use App\Http\Livewire\Admin\Customer\Grade\GradeProfitMargin;
use App\Http\Livewire\Admin\Customer\GradeEdit;
use App\Http\Livewire\Admin\Customer\ProfitMarginEdit;
use App\Http\Livewire\Admin\Reports\UserList;
use App\Http\Livewire\Admin\Search\SearchDetails;
use App\Http\Livewire\Admin\Search\SearchHistory;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('app.admin_prefix'), 'as' => 'admin.'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

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

        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/{user}/profit-margin', [CustomerController::class, 'profitMargin'])->name('profitMargin');

            Route::get('/{user}/import/profit-margin', [CustomerController::class, 'importProfitMarginView'])->name('profitMargin.import');
            Route::post('/{user}/import/profit-margin', [CustomerController::class, 'importProfitMargin']);

            Route::get('/{user}/import/new-rates', [CustomerController::class, 'newRateView'])->name('newRate');
            Route::post('/{user}/import/new-rates', [CustomerController::class, 'newRateImport']);
        });

        Route::get('/import/user', [CustomerController::class, 'importUserView'])->name('user.import');
        Route::post('/import/user', [CustomerController::class, 'importUser']);

        Route::resource('customer', CustomerController::class)->parameters([
            'customer' => 'user'
        ])->only(['index', 'create', 'edit', 'show']);

        Route::group(['prefix' => 'grades', 'as' => 'grades.'], function () {
            Route::get('/', Grade::class)->name('index');
            Route::get('/{grade}/edit', GradeEdit::class)->name('edit');
            Route::get('/{grade}/profit-margin', GradeProfitMargin::class)->name('profitMargin');
        });

        Route::get('/profit-margin/{profit_margin}/edit', ProfitMarginEdit::class)->name('profitMargin.edit');

        Route::group(['prefix' => 'integrator', 'as' => 'integrator.'], function () {
            Route::get('/{integrator}/rates/{type?}', [IntegratorController::class, 'ratesView'])->name('rates');

            Route::get('/{integrator}/upload/rates', [IntegratorController::class, 'uploadRatesView'])->name('uploadRates');
            Route::post('/{integrator}/upload/rates', [IntegratorController::class, 'uploadRates']);

            Route::get('/{integrator}/zones', [IntegratorController::class, 'zoneView'])->name('zones');
            Route::get('/{integrator}/upload/zones', [IntegratorController::class, 'uploadZoneView'])->name('uploadZones');
            Route::post('/{integrator}/upload/zones', [IntegratorController::class, 'uploadZone']);

            Route::get('/{integrator}/upload/od-pincodes', [IntegratorController::class, 'uploadOdPinView'])->name('uploadOdPin');
            Route::post('/{integrator}/upload/od-pincodes', [IntegratorController::class, 'uploadOdPin']);

            Route::get('/export', [IntegratorController::class, 'exportView'])->name('export');
            Route::post('/export', [IntegratorController::class, 'export']);
        });

        Route::resource('integrator', IntegratorController::class)->only(['index', 'create', 'store', 'edit', 'show']);


        Route::group(['prefix' => 'surcharge', 'as' => 'surcharge.'], function () {
            Route::get('/import', [SurchargeController::class, 'importView'])->name('import');
            Route::post('/import', [SurchargeController::class, 'import']);
        });
        Route::resource('surcharge', SurchargeController::class)->only(['index', 'create', 'edit']);


        Route::get('/searches', SearchHistory::class)->name('searches');
        Route::get('/searches/details/{search}', SearchDetails::class)->name('searches.details');

        Route::get('/bookings', BookingHistory::class)->name('bookings');
        Route::get('/bookings/details/{order}', BookingHistoryDetails::class)->name('bookings.details');

        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
            Route::get('/user', UserList::class)->name('user');
            Route::get('/user/details/{user}', [ReportsController::class, 'userDetails'])->name('user.details');
        });

        Route::resource('dynamic-content', DynamicContentsController::class)->only(['index', 'edit', 'update']);
        include_once 'profile.php';
    });
});
