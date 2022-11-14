<?php

namespace App\Observers;

use App\Models\Common\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsObserver
{
    /**
     * Handle the Settings "created" event.
     *
     * @param  \App\Models\Common\Settings  $settings
     * @return void
     */
    public function created(Settings $settings)
    {
        $this->flushCache();
    }

    /**
     * Handle the Settings "updated" event.
     *
     * @param  \App\Models\Common\Settings  $settings
     * @return void
     */
    public function updated(Settings $settings)
    {
        $this->flushCache();
    }

    /**
     * Handle the Settings "deleted" event.
     *
     * @param  \App\Models\Common\Settings  $settings
     * @return void
     */
    public function deleted(Settings $settings)
    {
        $this->flushCache();
    }

    /**
     * Handle the Settings "restored" event.
     *
     * @param  \App\Models\Common\Settings  $settings
     * @return void
     */
    public function restored(Settings $settings)
    {
        $this->flushCache();
    }

    /**
     * Handle the Settings "force deleted" event.
     *
     * @param  \App\Models\Common\Settings  $settings
     * @return void
     */
    public function forceDeleted(Settings $settings)
    {
        $this->flushCache();
    }

    public function flushCache()
    {
        Cache::forget('hubezKeys');
    }
}
