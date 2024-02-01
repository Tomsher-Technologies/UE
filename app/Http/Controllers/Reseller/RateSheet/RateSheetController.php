<?php

namespace App\Http\Controllers\Reseller\RateSheet;

use App\Exports\RateExport;
use App\Exports\RateZoneExport;
use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Models\Zones\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class RateSheetController extends Controller
{
    public function view()
    {
        $integrators = Integrator::all();
        $countries = Country::all();
        return view('reseller.ratesheet.export')->with([
            'integrators' => $integrators,
            'countries' => $countries
        ]);
    }
    public function download(Request $request)
    {
        $integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });
        $integrator = $integrators->where('id', $request->integrator)->first();
        $name = "$integrator->name Rate Sheet " . time() . '.xlsx';
        $export = new RateZoneExport($request);
        return Excel::download($export, $name);
    }
}
