<?php

namespace App\Http\Controllers\Admin\Integrators;

use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
use App\Http\Requests\StoreintegratorRequest;
use App\Http\Requests\UpdateintegratorRequest;
use App\Imports\ImportRateImport;
use Illuminate\Http\Request;
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

    public function uploadView(Integrator $integrator)
    {
        return view('admin.integrators.upload')->with([
            'integrator' => $integrator
        ]);
    }
    public function upload(Request $request, Integrator $integrator)
    {
        $request->validate([
            'importfile' => 'required|file|max:10000|mimes:xlsx,csv,txt'
        ], [
            'importfile.required' => 'Please select a file'
        ]);

        // $uploadedFile = $request->file('importfile');
        // $filename = time() . $uploadedFile->getClientOriginalName();

        // Storage::disk('local')->putFileAs(
        //     'uploaded/' . $filename,
        //     $uploadedFile,
        //     $filename
        // );

        $headings = (new HeadingRowImport)->toArray(request()->file('importfile'));

        $import = new ImportRateImport($integrator->id, $headings[0], 'import');

        Excel::import($import, request()->file('importfile'));

        return back()->with([
            'import_errors' => $import->errors
        ]);
    }
}
