<?php

namespace App\Http\Controllers;

use App\DataTables\CountiesDataTable;
use App\Http\Requests\StoreCountiesRequest;
use App\Http\Requests\UpdateCountiesRequest;
use App\Models\Counties;
use App\Models\Countries;

class CountiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountiesDataTable $request)
    {
        $countryList = Countries::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($countryList, '');

        $data = Counties::with('country')->get();

        return $request->render('page.counties.index', compact('data','countryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.county-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountiesRequest $request)
    {
        $county = Counties::updateOrCreate($request->validated());
        return response()->json(["status" => true, "message" => "Counties created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Counties  $ports
     * @return \Illuminate\Http\Response
     */
    public function show(Counties $county)
    {
        $html = view("models.county-view", compact('county'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Counties  $ports
     * @return \Illuminate\Http\Response
     */
    public function edit(Counties $county)
    {
        $html = view("models.county-update", compact('county'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountiesRequest  $request
     * @param  \App\Models\Counties  $ports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountiesRequest $request, $county)
    {
        $county = Counties::find($county)->update($request->validated());
        return response()->json(["status" => true, "message" => "Counties updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counties  $ports
     * @return \Illuminate\Http\Response
     */
    public function destroy($county)
    {
        $county = Counties::find($county);
        $county->delete();
        return response()->json(["status" => true, "message" => "Counties deleted"]);
    }
}
