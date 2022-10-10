<?php

namespace App\Http\Controllers\Admin\SpecialRate;

use App\Http\Controllers\Controller;
use App\Models\SpecialRate;
use App\Http\Requests\StoreSpecialRateRequest;
use App\Http\Requests\UpdateSpecialRateRequest;
use App\Models\User;

class SpecialRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sepcialrates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('admin.sepcialrates.create')->with([
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecialRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialRateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialRate  $specialRate
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, SpecialRate $specialRate)
    {
        return view('admin.sepcialrates.show')->with([
            'specialRate' => $specialRate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialRate  $specialRate
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, SpecialRate $specialRate)
    {
        return view('admin.sepcialrates.edit')->with([
            'user' => $user,
            'specialRate' => $specialRate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecialRateRequest  $request
     * @param  \App\Models\SpecialRate  $specialRate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecialRateRequest $request, SpecialRate $specialRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialRate  $specialRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialRate $specialRate)
    {
        //
    }
}
