<?php

use App\Models\Common\Settings;
use App\Models\Customer\Grade;
use App\Models\Customer\ProfitMargin;
use App\Models\SpecialRate;
use App\Models\Surcharge\Surcharge;
use App\Models\User;
use App\Models\Zones\Country;
use App\Models\Zones\OdPincodes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

function getSurcharge($integrator_id, $type, $billable_weight, $zone_code, $country, $country_code, $rate)
{
    $today = Carbon::now();

    $surcharges = Surcharge::whereIn('integrator_id', array('0', $integrator_id))
        ->whereIn('type', array('all', $type))
        ->where('status', 1)
        ->where('start_weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->whereDate('start_date', '<=', $today->startOfDay())
        ->whereDate('end_date', '>=', $today->endOfDay())
        ->orWhere('start_date', null)
        ->orWhere('end_date', null)
        ->orderBy('sort_order', 'ASC')
        ->get();

    // dd($surcharges);

    $surcharges = $surcharges->reject(function ($surcharge) use ($zone_code, $country) {
        if ($surcharge->applied_for == 'all') {
            return false;
        }
        if ($surcharge->applied_for == 'zone' && $surcharge->applied_for_id == $zone_code) {
            return false;
        }
        if ($surcharge->applied_for == 'country' && $surcharge->applied_for_id == $country) {
            return false;
        }
        return true;
    });

    // dd($surcharges);

    $total_surcharge_rate = 0;

    foreach ($surcharges as $surcharge) {
        $surcharge_rate = 0;

        if ($surcharge->rate_type == 1) {
            $surcharge_rate = $surcharge->rate;
        } else {
            $surcharge_rate = ($surcharge->rate / 100) * $rate;
        }

        if ($surcharge->per_weight) {
            $surcharge_rate = $surcharge_rate * $billable_weight;
        }

        $rate += $surcharge_rate;
    }

    return $rate;
}

function getUserFrofirMargin($integrator_id, $billable_weight, $zone, $country, $country_code, $type, $grade, $user_id, $rate, $package_type)
{
    $user = User::find($user_id);

    // $country_code = Country::where('id', $country)->get()->first()->code;

    $userMargins = $user
        ->profitmargin()
        ->whereIn('type', array('all', $type))
        ->where('weight', '<=', $billable_weight)
        ->where('end_weight', '>=', $billable_weight)
        ->whereIn('product_type', array('all', $package_type))
        ->whereIn('integrator_id', array(0, $integrator_id))
        ->whereDate('start_date', '<=', Carbon::now()->startOfDay())
        ->get();


    $userMargins = $userMargins->reject(function ($userMargin) use ($zone, $country_code) {
        if ($userMargin->applied_for == 'all') {
            return false;
        }
        if ($userMargin->applied_for == 'zone' && $userMargin->applied_for_id == $zone) {
            return false;
        }
        if ($userMargin->applied_for == 'country' && $userMargin->applied_for_country == $country_code) {
            return false;
        }
        return true;
    });


    return $userMargins;
}

function getFrofirMargin($integrator_id, $billable_weight, $zone, $country, $country_code, $type, $grade, $rate, $package_type)
{
    $total_margin = 0;

    $userMargins = getUserFrofirMargin($integrator_id, $billable_weight, $zone, $country, $country_code, $type, $grade, Auth()->user()->id, $rate, $package_type);
    foreach ($userMargins as $userMargin) {
        if ($userMargin->rate_type == 'amount') {
            $total_margin += $userMargin->rate;
        } else {
            // $total_margin += $userMargin->rate * $rate;
            $total_margin += ($userMargin->rate / 100) * $rate;
        }
    }

    // dd($total_margin);

    if (Auth()->user()->isA('reselleruser')) {
        $parent_user_margin = getUserFrofirMargin($integrator_id, $billable_weight, $zone, $country, $country_code, $type, $grade, Auth()->user()->parent_id, $rate, $package_type);
        if ($parent_user_margin->count()) {
            foreach ($parent_user_margin as $userMargin) {
                if ($userMargin->rate_type == 'amount') {
                    $total_margin += $userMargin->rate;
                } else {
                    $total_margin += $userMargin->rate * $rate;
                    // $total_margin += ($userMargin->rate / 100) * $rate;
                }
            }
        }
    }

    // dd($userMargins->count());

    if ($userMargins->count() <= 0) {
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
                $total_margin += ($margin->rate / 100) * $rate;
            }
        }
    }

    // $gradeMargins = $grade
    //     ->profitmargin()
    //     ->where('type', array('all', $type))
    //     ->whereIn('integrator_id', [$integrator_id, 0])
    //     ->where('weight', '<=', $billable_weight)
    //     ->where('end_weight', '>=', $billable_weight)
    //     ->get();

    // foreach ($gradeMargins as $margin) {
    //     if ($margin->rate_type == 'amount') {
    //         $total_margin += $margin->rate;
    //     } else {
    //         $total_margin += ($margin->rate / 100) * $rate;
    //     }
    // }

    return $total_margin;
}


function hasSpecialRequest($billable_weight, $search_id)
{

    $count = SpecialRate::where('search_id', $search_id)->count();

    if ($count >= 1) {
        return false;
    }

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


function weightCharges($request, $integrator_code, $billable_weight, $rate)
{
    $total_caharge = 0;

    if ($integrator_code == 'dhl') {
        $large = 0;
        foreach ($request->weight as $index => $weight) {
            $large = max($request->length[$index], $request->height[$index], $request->width[$index], $large);
            $vol_weight = volumetricWeight($request->length[$index], $request->height[$index], $request->width[$index]);
            $b_weight = $vol_weight > $weight ? $vol_weight : $weight;
            if ($large > 120 || $b_weight > 70) {
                $total_caharge += 165;
            }
        }
    }

    // Additional handling service
    if ($integrator_code == 'ups') {
        foreach ($request->length as $index => $length) {
            $secondSide = secondHighest(array($request->length[$index], $request->height[$index], $request->width[$index]));

            $vol_weight = volumetricWeight($request->length[$index], $request->height[$index], $request->width[$index]);
            $b_weight = max($vol_weight, $request->weight[$index]);

            if ($length > 122 || $secondSide > 76 || $b_weight > 32) {
                $total_caharge += 15;
            }

            $girth =  (2 * $request->width[$index]) + (2 * $request->height[$index]);
            $girth +=  $request->length[$index];

            // Large Package Surcharge
            if ($girth > 300 && $girth <= 400) {
                $total_caharge += 208;
            }

            // Over Maximum Limits
            if (
                $b_weight > 70 ||
                $request->length[$index] > 274 ||
                $girth > 400
            ) {
                $total_caharge += 393;
            }
        }
    }



    return $total_caharge;
}

function secondHighest($arry)
{
    $numbers = array_unique($arry);
    rsort($numbers);
    // if (count($numbers) > 1) {
    // }
    return $numbers[1] ?? $numbers[0];
}
