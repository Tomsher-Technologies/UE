<?php

use App\Models\Customer\Grade;
use App\Models\Customer\ProfitMargin;
use App\Models\Surcharge\Surcharge;
use Illuminate\Support\Facades\Auth;

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

function getFrofirMargin($integrator_id, $billable_weight, $zone, $country, $type)
{
    // profitmargin
    // user pf
    // grade
    // if sub, add parent pm
    $userMargins = Auth::user()
        ->profitmargin()
        ->where('weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->whereIn('integrator_id', [$integrator_id, 0])
        ->get();


    $grade = Grade::where('id', Auth::user()->grade_id)->first();

    $gradeMargins = $grade
        ->profitmargin()
        ->whereIn('integrator_id', [$integrator_id, 0])
        ->where('weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->get();

    if ($gradeMargins->count()) {
        ddd($gradeMargins);
    }
}
