<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Controller;
use App\Models\Common\DynamicContents;
use App\Http\Requests\StoreDynamicContentsRequest;
use App\Http\Requests\UpdateDynamicContentsRequest;

class DynamicContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dynamic.index');
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
     * @param  \App\Http\Requests\StoreDynamicContentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDynamicContentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Common\DynamicContents  $dynamicContents
     * @return \Illuminate\Http\Response
     */
    public function show(DynamicContents $dynamicContents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Common\DynamicContents  $dynamicContents
     * @return \Illuminate\Http\Response
     */
    public function edit(DynamicContents $dynamicContent)
    {
        // dd($dynamicContent);
        return view('admin.dynamic.edit')
            ->with([
                'dynamicContent' => $dynamicContent
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDynamicContentsRequest  $request
     * @param  \App\Models\Common\DynamicContents  $dynamicContents
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDynamicContentsRequest $request, DynamicContents $dynamicContent)
    {
        $dynamicContent->update($request->all());
        return redirect()->route('admin.settings.dynamic-content.index')->with(['status' => "Content updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Common\DynamicContents  $dynamicContents
     * @return \Illuminate\Http\Response
     */
    public function destroy(DynamicContents $dynamicContents)
    {
        //
    }
}
