<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Models\Orders\Search;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\OverWeightRate;
use App\Models\Rates\TransitRate;
use App\Models\Surcharge\Surcharge;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Helpers\CalculationHelpers;
use App\Models\Customer\Grade;
use App\Models\Orders\SearchItem;
use App\Models\Zones\City;
use App\Models\Zones\OdPincodes;

class SearchController extends Controller
{
    public function searchNew(Request $request)
    {
        $search_id = $this->saveSearch($request);

        $grade = Grade::where('id', Auth::user()->grade_id)->first();

        $del_type = $request->shipping_type;
        $package_type = $request->package_type;

        if ($del_type == 'export') {
            $model = ExportRate::class;
            $country = $request->toCountry;
        } else if ($del_type == 'import') {
            $country = $request->fromCountry;
            $model = ImportRate::class;
        } else {
            $country = $request->toCountry;
            $model = TransitRate::class;
        }

        $integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });

        $od_pincodes = OdPincodes::where('country_id', $country)
            ->whereIn('pincode', [$request->toPincode, $request->toCity])
            ->get();

        $country_id = [];
        $c_code = Country::where('id', $country)->get()->first()->code;
        $country_id = Country::where('code', $c_code)->get()->pluck('id')->toArray();


        foreach ($integrators as $integrator) {
            $billable_weight = $this->calculateWeight($request, $integrator->integrator_code);
            $integrator->billable_weight = $billable_weight;

            $zone = Zone::where('integrator_id', $integrator->id)->where('type', $del_type)->whereIn('country_id', $country_id)->first();

            if ($zone) {
                $zone_code = $zone->zone_code;
            }

            if ($zone) {
                $over_weight = OverWeightRate::where('integrator_id', $integrator->id)
                    ->where('shipment_type', $del_type)
                    ->where('zone_code', $zone_code)
                    ->where('from_weight', '<=', $billable_weight)
                    ->where('end_weight', '>=', $billable_weight)
                    ->first();

                if ($over_weight && $over_weight->count()) {
                    $integrator->weight = $over_weight;

                    // $highest  = $model::where('zone_code', $zone_code)->where('integrator_id', $integrator->id)->where('pack_type', $package_type)->where('weight', '>=', $billable_weight)->first();

                    $wei = $billable_weight * $integrator->rate_multiplier;

                    $integrator->weight->rate *= $wei;

                    // if ($integrator->id == 2) {
                    //     dd($over_weight);
                    // }

                    // if ($highest) {
                    //     $integrator->weight->rate += $highest->rate;
                    // }
                } else {
                    $weight = $model::where('zone_code', $zone_code)->where('integrator_id', $integrator->id)->where('pack_type', $package_type)->where('weight', '>=', $billable_weight)->first();
                    $integrator->weight = $weight;
                }

                if ($integrator->weight) {
                    // add out of delivery charge
                    // dd($integrator->weight);

                    if ($integrator->weight->from_weight > 70 && $integrator->integrator_code == 'ups') {
                        $ups_charge = 0;
                        $ups_charge = $this->UPSCharge($request);
                        $integrator->weight->rate += $ups_charge;
                    }

                    $oda_controller = new ODAController();
                    $search = Search::find($search_id);
                    $oda_charge = $oda_controller->checkODA($integrator->integrator_code, $search);

                    $od_pincode = $od_pincodes->where('integrator_id', $integrator->id)->first();

                    if ($oda_charge) {
                        $integrator->weight->rate += $oda_charge;
                    }

                    // add surcharge
                    $integrator->weight->rate = getSurcharge($integrator->id, $del_type, $billable_weight, $zone_code, $country, $integrator->weight->rate);

                    // // // add profit margin
                    $integrator->weight->rate += getFrofirMargin($integrator->id, $billable_weight, $zone_code, $country, $del_type, $grade, $integrator->weight->rate, $request->package_type);

                    // // Round rate for final result
                    $integrator->weight->rate = round($integrator->weight->rate, 2);
                }
            }
        }

        $integrators = $integrators->reject(function ($integrator) {
            return $integrator->weight ? false : true;
        });

        // $integrators = $integrators->reject(function ($integrator) {
        //     return $integrator->weight->weight ? false : true;
        // });

        $hasSpecialRequest = hasSpecialRequest($billable_weight, $search_id);

        $search = Search::with(['toCountry', 'fromCountry'])->find($search_id);

        $actual_weight = 0;

        foreach ($request->weight as $weight) {
            $actual_weight += $weight;
        }

        return view('reseller.pages.searchresult_new')->with([
            'integrators' => $integrators,
            'hasSpecialRequest' => $hasSpecialRequest,
            'search_id' => $search_id,
            'search' => $search,
            'actual_weight' => $actual_weight,
        ]);
    }

    public function UPSCharge(Request $request)
    {
        $charge = 0;

        foreach ($request->weight as $index => $weight) {
            // Not multiply, add
            $girth = (2 * $request->width[$index]) + (2 * $request->height[$index]);
            if ($girth > 300 && $girth < 400) {
                $charge += 208;
            } else if ($girth > 400) {
                $charge += 393;
            }
        }

        return $charge;
    }

    public function saveSearch(Request $request)
    {
        $search_token = $request->search_token ?? Str::uuid()->toString();

        $result = Search::where('search_hash', $search_token)->first();

        if ($result) {
            return $result->id;
        }

        $search = Search::create([
            'user_id' => Auth::user()->id,
            'package_type' => $request->package_type,
            'shipment_type' => $request->shipping_type,
            'from_country' => $request->fromCountry,
            'from_city' => $request->fromCity,
            'from_pin' => $request->fromPincode,
            'to_country' => $request->toCountry,
            'to_city' => $request->toCity,
            'to_pin' => $request->toPincode,
            'number_of_pieces' => $request->no_pieces,
            'search_hash' =>  $search_token
        ]);

        foreach ($request->weight as $index => $weight) {
            $search->items()->create([
                'length' => $request->length[$index],
                'height' => $request->height[$index],
                'width' => $request->width[$index],
                'weight' => $request->weight[$index],
                'no_pieces' => $request->no_piece[$index],
            ]);
        }

        return $search->id;
    }

    public function specialRequest(Request $request)
    {
        $search = Search::find($request->sid);
        $search->load('items');
        $actual_weight = $search->items->sum('weight');

        $rate = Auth()->user()->specialrate()->create([
            'search_id' => $search->id,
            'integrator_id' => $request->iid,
            'request_rate' => $request->request_rate,
            'rate_type' => 1,
            'request_date' => Carbon::now(),
            'expiry_date' => Carbon::now()->addDays(7),
            'status' => 0,
            'actual_weight' => $actual_weight,
            'original_rate' => $request->rate,
            'total_weight' => $request->total_weight,
        ]);

        return json_encode(array('status' => 'ok'));
    }

    public function searchView()
    {
        return view('reseller.pages.search');
    }

    public function calculateWeight(Request $request, $integrator)
    {
        $actual_weight = 0;

        switch ($integrator) {
            case 'ups':
                return $this->weightFormulaOne($request);
                break;

            case 'fedex':
                return $this->weightFormulaOne($request);
                break;

            case 'aramex':
                return $this->weightFormulaTwo($request);
                break;

            case 'dhl':
                return $this->weightFormulaOne($request);
                break;

            default:
                return $this->weightFormulaOne($request);
                break;
        }
    }

    public function weightFormulaOne(Request $request)
    {
        $actual_weight = 0;

        foreach ($request->weight as $index => $weight) {
            $vol_weight = volumetricWeight($request->length[$index], $request->height[$index], $request->width[$index]) * $request->no_piece[$index];
            $m_weight = $weight * $request->no_piece[$index];
            $actual_weight += ($vol_weight > $m_weight) ? $vol_weight : $m_weight;
        }

        return $actual_weight;
    }

    public function weightFormulaTwo(Request $request)
    {
        $actual_weight = 0;

        $total_weight = 0;
        $vol_weight = 0;

        foreach ($request->weight as $index => $weight) {
            $vol_weight += volumetricWeight($request->length[$index], $request->height[$index], $request->width[$index]) * $request->no_piece[$index];
            $total_weight += $weight * $request->no_piece[$index];
        }

        $actual_weight = ($vol_weight > $weight) ? $vol_weight : $weight;

        return $actual_weight;
    }

    // public function search(Request $request)
    // {
    //     $search_id = $this->saveSearch($request);

    //     if (config('addp.default_country_code') == $request->fromCountry) {
    //         $del_type = 'export';
    //         $model = ExportRate::class;
    //     } else if (config('addp.default_country_code') == $request->toCountry) {
    //         $del_type = 'import';
    //         $model = ImportRate::class;
    //     } else {
    //         $del_type = 'transit';
    //         $model = TransitRate::class;
    //     }

    //     $actual_weight = $this->calculateWeight($request);

    //     $toCountry = $request->toCountry;

    //     $integrators = Integrator::with(['zone' => function ($q) use ($toCountry, $del_type, $actual_weight) {
    //         $table = $del_type . '_rates';
    //         return $q->where('country_id', $toCountry)
    //             ->where('type', $del_type)
    //             ->leftJoin($table, function ($join)  use ($table, $actual_weight) {
    //                 $join->on('zones.id', '=', $table . '.zone_id')
    //                     ->where($table . '.weight', '>=', $actual_weight);
    //             })
    //             ->orderBy($table . '.weight', 'ASC')
    //             ->limit(1);
    //     }])->get();

    //     dd($integrators);

    //     $integrators = $integrators->reject(function ($integrator) {
    //         return $integrator->zone->count() > 0 ? false : true;
    //     });

    //     $integrators = $integrators->sortBy('zone.rate');

    //     return view('reseller.pages.searchresult')->with([
    //         'integrators' => $integrators,
    //         'actual_weight' => $actual_weight,
    //         'search_id' => $search_id,
    //     ]);
    // }

    public function searchHistory()
    {
        // $user_id = Auth()->user()->id;
        // $searches = Search::with(['toCountry', 'fromCountry', 'activeSpecialRate'])->where('user_id', $user_id)->paginate(15);
        // // dd($searches);
        // return view('reseller.pages.search_history')->with([
        //     'searches' => $searches,
        // ]);

        return view('reseller.pages.new_search_history');
    }

    public function searchHistoryItems(Request $request)
    {
        $items = SearchItem::where('search_id', $request->id)->get();
        return json_encode($items);
    }

    public function agentsSearchHistory()
    {
        $users = Auth()->user()->children()->select('id')->get()->toArray();
        $searches = Search::whereIn('user_id', $users)->with(['toCountry', 'fromCountry', 'user'])->paginate(15);
        return view('reseller.agents.search_history')->with([
            'searches' => $searches,
        ]);
    }
}
