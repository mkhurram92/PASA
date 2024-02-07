<?php

namespace App\Http\Controllers;

use App\DataTables\AncestorDataDataTable;
use App\Models\AncestorData;
use App\Http\Requests\StoreAncestorDataRequest;
use App\Http\Requests\UpdateAncestorDataRequest;
use App\Models\States;

class AncestorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AncestorDataDataTable $request)
    {
        return $request->render('page.ancestor-data.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $defaultState = States::where("name", "South Australia")->first();
        return view('page.ancestor-data.create', compact('defaultState'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAncestorDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAncestorDataRequest $request)
    {
        AncestorData::create($request->validated());
        return response()->json(["status" => true, "message" => "AncestorData created successfully", "redirectTo" => route("ancestor-data.index")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AncestorData  $ancestorData
     * @return \Illuminate\Http\Response
     */
    public function show($ancestorData)
    {
        $ancestor = AncestorData::with(['mode_of_travel', 'mode_of_travel.ship', 'occupation_relation', 'Voyage'])->find($ancestorData);
        return view('page.ancestor-data.view', compact('ancestor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AncestorData  $ancestorData
     * @return \Illuminate\Http\Response
     */
    public function edit($ancestorData)
    {
        $ancestor = AncestorData::with(['mode_of_travel', 'mode_of_travel.ship', 'occupation_relation', 'Voyage'])->find($ancestorData);
        return view('page.ancestor-data.update', compact('ancestor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAncestorDataRequest  $request
     * @param  \App\Models\AncestorData  $ancestorData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAncestorDataRequest $request, $ancestorData)
    {
        $ancestorData = AncestorData::find($ancestorData);
        $ancestorData->update($request->validated());

        return response()->json(["status" => true, "message" => "AncestorData updated successfully", "redirectTo" => route("ancestor-data.index")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AncestorData  $ancestorData
     * @return \Illuminate\Http\Response
     */
    public function destroy($ancestorData)
    {
        $ancestorData = AncestorData::find($ancestorData);
        $ancestorData->delete();
        return response()->json(["status" => true, "message" => "AncestorData Deleted Successfully"]);
    }
}
