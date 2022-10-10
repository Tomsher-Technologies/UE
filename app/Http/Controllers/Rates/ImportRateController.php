<?php

namespace App\Http\Controllers\Rates;

use App\Http\Controllers\Controller;
use App\Models\Rates\ImportRate;
use App\Http\Requests\StoreImportRateRequest;
use App\Http\Requests\UpdateImportRateRequest;

class ImportRateController extends Controller
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
     * @param  \App\Http\Requests\StoreImportRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImportRateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rates\ImportRate  $importRate
     * @return \Illuminate\Http\Response
     */
    public function show(ImportRate $importRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rates\ImportRate  $importRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportRate $importRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImportRateRequest  $request
     * @param  \App\Models\Rates\ImportRate  $importRate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImportRateRequest $request, ImportRate $importRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rates\ImportRate  $importRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportRate $importRate)
    {
        //
    }
}
