<?php

namespace App\Http\Controllers;

use App\Models\Integrators\integrator;
use App\Http\Requests\StoreintegratorRequest;
use App\Http\Requests\UpdateintegratorRequest;

class IntegratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(integrator $integrator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateintegratorRequest  $request
     * @param  \App\Models\Integrators\integrator  $integrator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateintegratorRequest $request, integrator $integrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Integrators\integrator  $integrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(integrator $integrator)
    {
        //
    }
}
