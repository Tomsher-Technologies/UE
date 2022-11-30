<?php

namespace App\Http\Controllers\Reseller\RateSheet;

use App\Exports\RateExport;
use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Models\Zones\Country;
use Illuminate\Http\Request;
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
        $name = "Rate Sheet " . time() . '.xlsx';
        $export = new RateExport($request);

        if ($export->data->count() <= 0) {
            return back()->with([
                'error' => 'No records found'
            ]);
        }

        return Excel::download($export, $name);
    }
}
