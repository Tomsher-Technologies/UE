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
use App\Models\Rates\ImportRate;
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
            return back()->with([
                'import_errors' => $import->errors
            ]);
        } else {
            return back()->with([
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
}
