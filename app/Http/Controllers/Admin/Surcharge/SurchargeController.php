<?php

namespace App\Http\Controllers\Admin\Surcharge;

use App\Http\Controllers\Controller;
use App\Models\Surcharge\Surcharge;
use App\Http\Requests\StoreSurchargeRequest;
use App\Http\Requests\UpdateSurchargeRequest;
use App\Imports\Admin\SurchageImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SurchargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.surcharge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.surcharge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSurchargeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurchargeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surcharge\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function show(Surcharge $surcharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surcharge\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function edit(Surcharge $surcharge)
    {
        return view('admin.surcharge.edit')->with([
            'surcharge' => $surcharge
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSurchargeRequest  $request
     * @param  \App\Models\Surcharge\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurchargeRequest $request, Surcharge $surcharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surcharge\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surcharge $surcharge)
    {
        //
    }

    public function importView()
    {
        return view('admin.surcharge.import');
    }
    public function import(Request $request)
    {
        $failures = null;
        try {
            $import = new SurchageImport();
            Excel::import($import, request()->file('importfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
        }

        if ($import->cus_errors || $failures) {

            return back()->with([
                'import_errors' => $import->cus_errors,
                'failures' => $failures
            ]);
        } else {
            return back()->with([
                'status' => "Import successful"
            ]);
        }
    }
}
