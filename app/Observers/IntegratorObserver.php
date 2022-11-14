<?php

namespace App\Observers;

use App\Models\Integrators\Integrator;
use Illuminate\Support\Facades\Cache;

class IntegratorObserver
{
    /**
     * Handle the Integrator "created" event.
     *
     * @param  \App\Models\Integrators\Integrator  $integrator
     * @return void
     */
    public function created(Integrator $integrator)
    {
        $this->flush();
    }

    /**
     * Handle the Integrator "updated" event.
     *
     * @param  \App\Models\Integrators\Integrator  $integrator
     * @return void
     */
    public function updated(Integrator $integrator)
    {
        $this->flush();
    }

    /**
     * Handle the Integrator "deleted" event.
     *
     * @param  \App\Models\Integrators\Integrator  $integrator
     * @return void
     */
    public function deleted(Integrator $integrator)
    {
        $this->flush();
    }

    /**
     * Handle the Integrator "restored" event.
     *
     * @param  \App\Models\Integrators\Integrator  $integrator
     * @return void
     */
    public function restored(Integrator $integrator)
    {
        $this->flush();
    }

    /**
     * Handle the Integrator "force deleted" event.
     *
     * @param  \App\Models\Integrators\Integrator  $integrator
     * @return void
     */
    public function forceDeleted(Integrator $integrator)
    {
        $this->flush();
    }

    public function flush()
    {
        Cache::forget('integrators');
    }
}
