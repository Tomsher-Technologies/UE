<?php

namespace App\Http\Controllers;

use App\Models\Rates\TransitRate;
use App\Http\Requests\StoreTransitRateRequest;
use App\Http\Requests\UpdateTransitRateRequest;

class TransitRateController extends Controller
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
     * @param  \App\Http\Requests\StoreTransitRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransitRateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rates\TransitRate  $transitRate
     * @return \Illuminate\Http\Response
     */
    public function show(TransitRate $transitRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rates\TransitRate  $transitRate
     * @return \Illuminate\Http\Response
     */
    public function edit(TransitRate $transitRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransitRateRequest  $request
     * @param  \App\Models\Rates\TransitRate  $transitRate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransitRateRequest $request, TransitRate $transitRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rates\TransitRate  $transitRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransitRate $transitRate)
    {
        //
    }
}
