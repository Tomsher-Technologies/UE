<?php

namespace App\Providers;

use App\Models\Common\Settings;
use App\Models\Integrators\Integrator;
use App\Observers\IntegratorObserver;
use App\Observers\SettingsObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Settings::observe(SettingsObserver::class);
        Integrator::observe(IntegratorObserver::class);
    }
}
