<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Common\DynamicContentsController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Integrators\IntegratorController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SpecialRate\SpecialRateController;
use App\Http\Controllers\Admin\Surcharge\SurchargeController;
use App\Http\Controllers\Admin\UEUser\UEUserController;
use App\Http\Controllers\HubEz\HubEzController;
use App\Http\Controllers\Reseller\ODAController;
use App\Http\Livewire\Admin\Booking\BookingHistory;
use App\Http\Livewire\Admin\Booking\BookingHistoryDetails;
use App\Http\Livewire\Admin\Customer\Grade;
use App\Http\Livewire\Admin\Customer\Grade\GradeProfitMargin;
use App\Http\Livewire\Admin\Customer\GradeEdit;
use App\Http\Livewire\Admin\Customer\ProfitMargin;
use App\Http\Livewire\Admin\Customer\ProfitMarginEdit;
use App\Http\Livewire\Admin\Search\SearchHistory;
use App\Mail\Admin\NewCustomerMail;
use App\Models\Common\Settings;
use App\Models\Integrators\Uploads;
use App\Models\Orders\Search;
use App\Models\User;
use App\Notifications\Admin\NewUserNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group(['prefix' => config('app.admin_prefix'), 'as' => 'admin.'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/test', function () {

        // Uploads::where([
        //     'path' => 'storage/uploaded/rates/1674016148DHL Import.csv/1674016148DHL Import.csv'
        // ])->delete();

        // $oda_controller = new ODAController();

        // $search_id = Search::find(19);

        // // dd($search_id);

        // $oda_charge = $oda_controller->checkODA('dhl', $search_id);

        // dd($oda_charge);
    });

    // Route::get('/test', [HubEzController::class, 'placeOrder']);

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

        Route::resource('integrator', IntegratorController::class)->only(['index', 'create', 'edit', 'show']);


        Route::group(['prefix' => 'surcharge', 'as' => 'surcharge.'], function () {
            Route::get('/import', [SurchargeController::class, 'importView'])->name('import');
            Route::post('/import', [SurchargeController::class, 'import']);
        });
        Route::resource('surcharge', SurchargeController::class)->only(['index', 'create', 'edit']);


        Route::get('/searches', SearchHistory::class)->name('searches');
        Route::get('/bookings', BookingHistory::class)->name('bookings');
        Route::get('/bookings/details/{order}', BookingHistoryDetails::class)->name('bookings.details');

        Route::name('special_rates.')->group(function () {
            Route::get('/special_rates', [SpecialRateController::class, 'index'])->name('index');
            Route::get('/special_rates/{special_rate}/edit/', [SpecialRateController::class, 'edit'])->name('edit');
        });


        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
            Route::get('/', [ReportsController::class, 'index'])->name('index');
        });

        Route::resource('dynamic-content', DynamicContentsController::class)->only(['index', 'edit', 'update']);
        include_once 'profile.php';
    });
});
