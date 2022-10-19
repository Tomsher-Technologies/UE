<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $del_type = 'transit';

        if (config('addp.default_country_code') == $request->fromCountry) {
            $del_type = 'export';
        }
        if (config('addp.default_country_code') == $request->toCountry) {
            $del_type = 'import';
        }

        switch ($del_type) {
            case "transit":
                $model = TransitRate::class;
            case "export":
                $model = ExportRate::class;
            case "import":
                $model = ImportRate::class;
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
                ->join($table, function ($join)  use ($table, $total_weight) {
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
            'integrators' => $integrators
        ]);
    }
}
