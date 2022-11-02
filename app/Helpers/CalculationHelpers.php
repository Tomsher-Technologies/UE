<?php

use App\Models\Surcharge\Surcharge;

function getSurcharge($integrator_id, $billable_weight, $zone, $country)
{
    $surcharges = Surcharge::where('integrator_id', $integrator_id)
        ->where('status', 1)
        ->where('start_weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->get();


    $surcharges = $surcharges->reject(function ($surcharge) use ($zone, $country) {
        if ($surcharge->applied_for == 'all') {
            return false;
        }
        if ($surcharge->applied_for == 'zone' && $surcharge->applied_for_id == $zone->id) {
            return false;
        }
        if ($surcharge->applied_for == 'country' && $surcharge->applied_for_id == $country) {
            return false;
        }
        return true;
    });

    foreach ($surcharges as $surcharge) {
        if ($surcharge->rate_type == 1) {
            return $surcharge->rate;
        } else {
            return ($surcharge->rate / 100) * $zone->weight->rate;
        }
    }
}
