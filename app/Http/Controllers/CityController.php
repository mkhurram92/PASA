<?php

namespace App\Http\Controllers;

use App\DataTables\CitiesDataTable;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Counties;
use App\Models\Countries;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDataTable $request)
    {
        $county = Counties::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($county, '');

        $country = Countries::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($country, '');

        $city = City::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($city, '');

        $data = City::with('county.country:id,name')->get(['id', 'name', 'county_id']);

        return $request->render('page.cities.index', compact('data', 'county', 'country','city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
  
        $html = view("models.city-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\Responsey
     */
    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->validated());
        return response()->json(["status" => true, "message" => "City created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $ports
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $html = view("models.city-view", compact('city'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $ports
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $html = view("models.city-update", compact('city'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $ports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $city)
    {
        $city = City::find($city)->update($request->validated());
        return response()->json(["status" => true, "message" => "City updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $ports
     * @return \Illuminate\Http\Response
     */
    public function destroy($city)
    {
        $city = City::findOrFail($city);
        $city->delete();
        return response()->json(["status" => true, "message" => "City deleted"]);
    }

    public function getCitiesJson(Request $request)
    {
        $search = $request->search;
        $cities = City::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })
            ->where("county_id", $request->county)
            ->get();

        $response = array();
        foreach ($cities as $city) {
            $response[] = array(
                "id" => $city->id,
                "text" => $city->name
            );
        }

        return response()->json($response);
    }
}
