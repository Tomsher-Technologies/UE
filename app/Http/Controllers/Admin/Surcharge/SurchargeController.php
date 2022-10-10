<?php

namespace App\Http\Controllers\Admin\Surcharge;

use App\Http\Controllers\Controller;
use App\Models\Surcharge\Surcharge;
use App\Http\Requests\StoreSurchargeRequest;
use App\Http\Requests\UpdateSurchargeRequest;

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
}
