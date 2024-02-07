<?php

namespace App\Http\Controllers;

use App\DataTables\CountriesDataTable;
use App\Http\Requests\StoreCountriesRequest;
use App\Http\Requests\UpdateCountriesRequest;
use App\Models\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTable $request)
    {
        return $request->render('page.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.country-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountriesRequest $request)
    {
        $country = Countries::create($request->validated());
        return response()->json(["status" => true, "message" => "Countries created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Countries $country
     * @return \Illuminate\Http\Response
     */
    public function show(Countries $country)
    {
        $html = view("models.country-view", compact('country'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Countries $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Countries $country)
    {
        $html = view("models.country-update", compact('country'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountriesRequest  $request
     * @param  \App\Models\Countries $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountriesRequest $request, $country)
    {
        $country = Countries::find($country)->update($request->validated());
        return response()->json(["status" => true, "message" => "Countries updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Countries $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($country)
    {
        $country = Countries::findOrFail($country);
        $country->delete();
        return response()->json(["status" => true, "message" => "Countries deleted"]);
    }

    public function getCountriesJson(Request $request)
    {
        $search = $request->search;
        $countries = Countries::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->get();

        $response = array();
        foreach ($countries as $country) {
            $response[] = array(
                "id" => $country->id,
                "text" => $country->name
            );
        }

        return response()->json($response);
    }
}
