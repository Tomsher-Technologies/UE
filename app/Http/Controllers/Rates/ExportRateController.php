<?php

namespace App\Http\Controllers\Rates;

use App\Http\Controllers\Controller;
use App\Models\Rates\ExportRate;
use App\Http\Requests\StoreExportRateRequest;
use App\Http\Requests\UpdateExportRateRequest;

class ExportRateController extends Controller
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
     * @param  \App\Http\Requests\StoreExportRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExportRateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rates\ExportRate  $exportRate
     * @return \Illuminate\Http\Response
     */
    public function show(ExportRate $exportRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rates\ExportRate  $exportRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ExportRate $exportRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExportRateRequest  $request
     * @param  \App\Models\Rates\ExportRate  $exportRate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExportRateRequest $request, ExportRate $exportRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rates\ExportRate  $exportRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExportRate $exportRate)
    {
        //
    }
}
