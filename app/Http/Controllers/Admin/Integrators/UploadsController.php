<?php

namespace App\Http\Controllers\Admin\Integrators;

use App\Http\Controllers\Controller;
use App\Models\Integrators\Uploads;
use App\Http\Requests\StoreUploadsRequest;
use App\Http\Requests\UpdateUploadsRequest;

class UploadsController extends Controller
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
     * @param  \App\Http\Requests\StoreUploadsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Integrators\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function show(Uploads $uploads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Integrators\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function edit(Uploads $uploads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadsRequest  $request
     * @param  \App\Models\Integrators\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadsRequest $request, Uploads $uploads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Integrators\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uploads $uploads)
    {
        //
    }
}
