<?php

use App\Models\Common\Settings;
use App\Models\Customer\Grade;
use App\Models\Customer\ProfitMargin;
use App\Models\Surcharge\Surcharge;
use App\Models\User;
use App\Models\Zones\OdPincodes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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


function getUserFrofirMargin($integrator_id, $billable_weight, $zone, $country, $type, $grade, $user_id)
{

    $user = User::find($user_id);

    $userMargins = $user
        ->profitmargin()
        ->whereIn('type', array('all', $type))
        ->where('weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->whereIn('integrator_id', array(0, $integrator_id))
        ->get();

    $userMargins = $userMargins->reject(function ($userMargin) use ($zone, $country) {
        if ($userMargin->applied_for == 'all') {
            return false;
        }
        if ($userMargin->applied_for == 'zone' && $userMargin->applied_for_id == $zone->id) {
            return false;
        }
        if ($userMargin->applied_for == 'country' && $userMargin->applied_for_id == $country) {
            return false;
        }
        return true;
    });

    return $userMargins;
}

function getFrofirMargin($integrator_id, $billable_weight, $zone, $country, $type, $grade)
{
    $total_margin = 0;

    $userMargins = getUserFrofirMargin($integrator_id, $billable_weight, $zone, $country, $type, $grade, Auth()->user()->id);
    foreach ($userMargins as $userMargin) {
        if ($userMargin->rate_type == 'amount') {
            $total_margin += $userMargin->rate;
        } else {
            $total_margin += ($userMargin->rate / 100) * $zone->weight->rate;
        }
    }

    if (Auth()->user()->isA('reselleruser')) {
        $parent_user_margin = getUserFrofirMargin($integrator_id, $billable_weight, $zone, $country, $type, $grade, Auth()->user()->parent_id);

        if ($parent_user_margin->count()) {
            foreach ($parent_user_margin as $userMargin) {
                if ($userMargin->rate_type == 'amount') {
                    $total_margin += $userMargin->rate;
                } else {
                    $total_margin += ($userMargin->rate / 100) * $zone->weight->rate;
                }
            }
        }
    }

    $gradeMargins = $grade
        ->profitmargin()
        ->where('type', array('all', $type))
        ->whereIn('integrator_id', [$integrator_id, 0])
        ->where('weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->get();

    foreach ($gradeMargins as $margin) {
        if ($margin->rate_type == 'amount') {
            $total_margin += $margin->rate;
        } else {
            $total_margin += ($margin->rate / 100) * $zone->weight->rate;
        }
    }

    return $total_margin;
}


function hasSpecialRequest($billable_weight)
{
    $user = Auth()->user();
    $user->load(['customerDetails']);

    $global_daily_limit = Cache::rememberForever('global_daily_limit', function () {
        return Settings::where('group', 'booking')->get();
    });

    $request_today = $user->specialrate()->whereDate('created_at', Carbon::today())->count();

    if (
        $user->customerDetails->limit_weight > $billable_weight ||
        $request_today >= $user->customerDetails->limit_weight
    ) {
        return false;
    }

    return true;
}
