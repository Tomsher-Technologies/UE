<?php

namespace App\Http\Controllers\Admin\Integrators;

use App\Exports\RateByWeightExport;
use App\Exports\RateExport;
use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Http\Requests\StoreintegratorRequest;
use App\Http\Requests\UpdateintegratorRequest;
use App\Imports\ImportRateImport;
use App\Imports\ODPicodeImport;
use App\Imports\ZoneImport;
use App\Models\Integrators\Uploads;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class IntegratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.integrators.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.integrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreintegratorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreintegratorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Integrators\integrator  $integrator
     * @return \Illuminate\Http\Response
     */
    public function show(integrator $integrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Integrators\integrator  $integrator
     * @return \Illuminate\Http\Response
     */
    public function edit(Integrator $integrator)
    {
        return view('admin.integrators.edit')->with([
            'integrator' => $integrator
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateintegratorRequest  $request
     * @param  \App\Models\Integrators\integrator  $integrator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateintegratorRequest $request, Integrator $integrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Integrators\integrator  $integrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integrator $integrator)
    {
        //
    }

    public function uploadRatesView(Integrator $integrator)
    {
        return view('admin.integrators.upload')->with([
            'integrator' => $integrator
        ]);
    }
    public function uploadRates(Request $request, Integrator $integrator)
    {
        $request->validate([
            'importfile' => 'required|file|max:10000|mimes:xlsx,csv,txt',
            'type' => 'required',
        ], [
            'importfile.required' => 'Please select a file',
            'type.required' => 'Please select a rate type',
        ]);

        $uploadedFile = $request->file('importfile');
        $filename = time() . $uploadedFile->getClientOriginalName();

        $file = Storage::disk('public')->putFileAs(
            'uploaded/rates/' . $filename,
            $uploadedFile,
            $filename
        );

        Uploads::create([
            'integrator_id' => $integrator->id,
            'name' => $filename,
            'type' => ucfirst($request->type) . " " . "Rate",
            'path' => 'storage/' . $file,
        ]);

        $headings = (new HeadingRowImport)->toArray(request()->file('importfile'));

        $import = new ImportRateImport($integrator->id, $headings[0], $request->type);

        Excel::import($import, request()->file('importfile'));

        if ($import->errors || $import->error_missing) {
            return back()->with([
                'import_errors' => $import->errors,
                'error_missing' => $import->error_missing
            ]);
        } else {
            return back()->with([
                'status' => "Import successful"
            ]);
        }
    }

    public function uploadZoneView(Integrator $integrator)
    {
        return view('admin.integrators.uploadzone')->with([
            'integrator' => $integrator
        ]);
    }
    public function uploadZone(Request $request, Integrator $integrator)
    {
        $request->validate([
            'importfile' => 'required|file|max:10000|mimes:xlsx,csv,txt',
        ], [
            'importfile.required' => 'Please select a file',
        ]);

        $uploadedFile = $request->file('importfile');
        $filename = time() . $uploadedFile->getClientOriginalName();

        $file = Storage::disk('public')->putFileAs(
            'uploaded/zones/' . $filename,
            $uploadedFile,
            $filename
        );

        Uploads::create([
            'integrator_id' => $integrator->id,
            'name' => $filename,
            'type' => ucfirst($request->type) . " " . "Zone",
            'path' => 'storage/' . $file,
        ]);

        $import = new ZoneImport($integrator->id, $request->type);

        Excel::import($import, request()->file('importfile'));


        if ($import->errors) {
            return redirect()->back()->with([
                'zone_import_errors' => $import->errors
            ]);
        } else {
            return redirect()->route('admin.integrator.edit', $integrator)->with([
                'status' => "Import successful"
            ]);
        }
    }

    public function uploadOdPinView(Integrator $integrator)
    {
        return view('admin.integrators.uploadpins')->with([
            'integrator' => $integrator
        ]);
    }
    public function uploadOdPin(Request $request, Integrator $integrator)
    {
        $request->validate([
            'importfile' => 'required|file|max:10000|mimes:xlsx,csv,txt',
        ], [
            'importfile.required' => 'Please select a file',
        ]);

        $uploadedFile = $request->file('importfile');
        $filename = time() . $uploadedFile->getClientOriginalName();

        $file = Storage::disk('public')->putFileAs(
            'uploaded/odpincodes/' . $filename,
            $uploadedFile,
            $filename
        );

        Uploads::create([
            'integrator_id' => $integrator->id,
            'name' => $filename,
            'type' => "OD Pincode",
            'path' => 'storage/' . $file,
        ]);

        $import = new ODPicodeImport($integrator->id);

        Excel::import($import, request()->file('importfile'));

        if ($import->errors) {
            return back()->with([
                'import_errors' => $import->errors
            ]);
        } else {
            return back()->with([
                'status' => "Import successful"
            ]);
        }
    }

    public function exportView()
    {
        $integrators = Integrator::all();
        $countries = Country::all();
        return view('admin.integrators.export')->with([
            'integrators' => $integrators,
            'countries' => $countries
        ]);
    }

    public function export(Request $request)
    {
        $name = "Rate Sheet " . time() . '.xlsx';
        // if ($request->export_by == 'integrator') {
        $export = new RateExport($request);
        // } else {
        //     $export = new RateByWeightExport($request);
        // }

        if ($export->data->count() <= 0) {
            return back()->with([
                'error' => 'No records found'
            ]);
        }

        return Excel::download($export, $name);
    }

    public function zoneView(Integrator $integrator)
    {
        $zones = Zone::where('integrator_id', $integrator->id)->with('country')->get()->groupBy('type');
        return view('admin.integrators.views.zone')->with(['zones' => $zones]);
    }

    public function ratesView(Integrator $integrator, $type = 'import')
    {
        // transit

        if ($type == 'export') {
            $model = ExportRate::class;
        } else if ($type == 'import') {
            $model = ImportRate::class;
        } else if ($type == 'transit') {
            $model = TransitRate::class;
        } else {
            abort(404);
        }

        $zone = Zone::where('integrator_id', $integrator->id)->where('type', $type)->with('country')->get();
        $transit_zone_unique = $zone->sortBy('zone_code')->pluck('zone_code')->unique()->toArray();
        $transit = $model::where('integrator_id', $integrator->id)->get();
        $unique_types = $transit->sortBy('pack_type')->pluck('pack_type')->unique()->toArray();

        $unique_weight = [];

        foreach ($unique_types as $unique_type) {
            $unique_weight[$unique_type] = $transit->where('pack_type', '=', $unique_type)->pluck('weight')->unique();
        }

        $collection1 = new Collection([]);

        foreach ($unique_types as $unique_type) {
            foreach ($unique_weight[$unique_type] as $weight) {
                $array = [];
                foreach ($transit_zone_unique as  $zone) {
                    $rate = $transit->where('pack_type', $unique_type)->where('zone_code', $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
                    if ($rate) {
                        $array['weight'] = $weight;
                        $array['type'] = $unique_type;
                        $array[$zone]  = $rate;
                    }
                }

                $collection1->push($array);
            }
        }

        // import
        // $zone = Zone::where('integrator_id', $integrator->id)->where('type', 'import')->with('country')->get();
        // $import_zone_unique = $zone->sortBy('zone_code')->pluck('zone_code')->unique()->toArray();
        // $transit = ImportRate::where('integrator_id', $integrator->id)->get();
        // $unique_types = $transit->sortBy('pack_type')->pluck('pack_type')->unique()->toArray();

        // $unique_weight = [];

        // foreach ($unique_types as $unique_type) {
        //     $unique_weight[$unique_type] = $transit->where('pack_type', '=', $unique_type)->pluck('weight')->unique();
        // }

        // $collection2 = new Collection([]);

        // foreach ($unique_types as $unique_type) {
        //     foreach ($unique_weight[$unique_type] as $weight) {
        //         $array = [];
        //         foreach ($import_zone_unique as  $zone) {
        //             $rate = $transit->where('pack_type', $unique_type)->where('zone_code', $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
        //             if ($rate) {
        //                 $array['weight'] = $weight;
        //                 $array['type'] = $unique_type;
        //                 $array[$zone]  = $rate;
        //             }
        //         }

        //         $collection2->push($array);
        //     }
        // }


        // export
        // $zone = Zone::where('integrator_id', $integrator->id)->where('type', 'export')->with('country')->get();
        // $export_zone_unique = $zone->sortBy('zone_code')->pluck('zone_code')->unique()->toArray();
        // $transit = ExportRate::where('integrator_id', $integrator->id)->get();
        // $unique_types = $transit->sortBy('pack_type')->pluck('pack_type')->unique()->toArray();

        // $unique_weight = [];

        // foreach ($unique_types as $unique_type) {
        //     $unique_weight[$unique_type] = $transit->where('pack_type', '=', $unique_type)->pluck('weight')->unique();
        // }

        // $collection3 = new Collection([]);

        // foreach ($unique_types as $unique_type) {
        //     foreach ($unique_weight[$unique_type] as $weight) {
        //         $array = [];
        //         foreach ($export_zone_unique as  $zone) {
        //             $rate = $transit->where('pack_type', $unique_type)->where('zone_code', $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
        //             if ($rate) {
        //                 $array['weight'] = $weight;
        //                 $array['type'] = $unique_type;
        //                 $array[$zone]  = $rate;
        //             }
        //         }

        //         if (!empty($array)) {
        //             $collection3->push($array);
        //         }
        //     }
        // }

        // dd($collection1->sortBy('type'));

        return view('admin.integrators.views.rate')
            ->with([
                'rates' => $collection1->sortBy(['type', 'weight']),
                'zones' => $transit_zone_unique,
                'type' => $type,
                // 'import' => $collection2->sortBy(['type', 'weight']),
                // 'import_zones' => $import_zone_unique,
                // 'export' => $collection3->sortBy(['type', 'weight']),
                // 'export_zones' => $export_zone_unique,
            ]);

        // $export = ExportRate::where('integrator_id', $integrator->id)->get();
        // $transit = TransitRate::where('integrator_id', $integrator->id)->get()->dd();
    }
}
