<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Models\Orders\Search;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_id = $this->saveSearch($request);

        if (config('addp.default_country_code') == $request->fromCountry) {
            $del_type = 'export';
            $model = ExportRate::class;
        } else if (config('addp.default_country_code') == $request->toCountry) {
            $del_type = 'import';
            $model = ImportRate::class;
        } else {
            $del_type = 'transit';
            $model = TransitRate::class;
        }

        $total_weight = 0;

        foreach ($request->weight as $weight) {
            $total_weight += $weight;
        }

        $toCountry = $request->toCountry;

        $integrators = Integrator::with(['zone' => function ($q) use ($toCountry, $del_type, $total_weight) {
            $table = $del_type . '_rates';
            return $q->where('country_id', $toCountry)
                ->where('type', $del_type)
                ->leftJoin($table, function ($join)  use ($table, $total_weight) {
                    $join->on('zones.id', '=', $table . '.zone_id')
                        ->where($table . '.weight', '>=', $total_weight);
                })
                ->orderBy($table . '.weight', 'ASC')
                ->limit(1);
        }])->get();

        $integrators = $integrators->reject(function ($integrator) {
            return $integrator->zone->count() > 0 ? false : true;
        });

        $integrators = $integrators->sortBy('zone.rate');

        return view('reseller.pages.searchresult')->with([
            'integrators' => $integrators,
            'total_weight' => $total_weight,
            'search_id' => $search_id,
        ]);
    }

    public function saveSearch(Request $request)
    {
        $search = Search::create([
            'user_id' => Auth::user()->id,
            'from_country' => $request->fromCountry,
            'from_city' => $request->fromCity,
            'from_pin' => $request->fromPincode,
            'to_country' => $request->toCountry,
            'to_city' => $request->toCity,
            'to_pin' => $request->toPincode,
            'number_of_pieces' => $request->no_pieces,
        ]);

        foreach ($request->weight as $index => $weight) {
            $search->items()->create([
                'length' => $request->length[$index],
                'height' => $request->height[$index],
                'width' => $request->width[$index],
                'weight' => $request->weight[$index],
            ]);
        }

        return $search->id;
    }

    public function specialRequest(Request $request)
    {
        $search = Search::find($request->sid);
        $search->load('items');
        $total_weight = $search->items->sum('weight');

        $rate = Auth()->user()->specialrate()->create([
            'search_id' => $search->id,
            'integrator_id' => $request->iid,
            'request_rate' => $request->request_rate,
            'rate_type' => 1,
            'request_date' => Carbon::now(),
            'expiry_date' => Carbon::now()->addDays(7),
            'status' => 0,
            'total_weight' => $total_weight,
            'original_rate' => $request->rate
        ]);

        return json_encode(array('status' => 'ok'));
    }
}
