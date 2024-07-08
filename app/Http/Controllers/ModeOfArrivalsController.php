<?php

namespace App\Http\Controllers;

use App\DataTables\ModeOfArrivalsDataTable;
use App\Models\ModeOfArrivals;
use App\Models\Ship;
use App\Http\Requests\StoreModeOfArrivalsRequest;
use App\Http\Requests\UpdateModeOfArrivalsRequest;
use App\Models\Ports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this line


class ModeOfArrivalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ModeOfArrivalsDataTable $request)
    {
        $shipNames = Ship::orderBy('name_of_ship', 'asc')->pluck('name_of_ship')->toArray();
        array_unshift($shipNames, '');

        $arrivalAt = Ports::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($arrivalAt, '');

        $mode_of_arrival = ModeOfArrivals::with('ship', 'country', 'county', 'city', 'port')->get();

        return $request->render('page.mode-of-arrivals.index', compact('mode_of_arrival', 'shipNames', 'arrivalAt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.mode-of-arrivals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModeOfArrivalsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModeOfArrivalsRequest $request)
    {
        $data = $request->validated();
        //Log::debug('Validated data:', $data);
        
        // Save only the 'ship_id' and non-null fields from $data
        $filteredData = array_filter($data, function($value) {
            return !is_null($value);
        });
           
        ModeOfArrivals::create($filteredData);
    
        return response()->json(['status' => true, "message" => "Arrival created", "redirectTo" => route("mode-of-arrivals.index")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModeOfArrivals  $modeOfArrivals
     * @return \Illuminate\Http\Response
     */
    public function show($modeOfArrivals)
    {
        $modeOfArrival = ModeOfArrivals::findOrFail($modeOfArrivals);

        return view('page.mode-of-arrivals.view', compact('modeOfArrival'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModeOfArrivals  $modeOfArrivals
     * @return \Illuminate\Http\Response
     */
    public function edit($modeOfArrivals)
    {
        try {
            $modeOfArrival = ModeOfArrivals::findOrFail($modeOfArrivals);
            return view('page.mode-of-arrivals.update', compact('modeOfArrival'));
        } catch (\Throwable $th) {
            return redirect()->route("mode-of-arrivals.index")->with("error", "Arrival not found");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModeOfArrivalsRequest  $request
     * @param  \App\Models\ModeOfArrivals  $modeOfArrivals
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModeOfArrivalsRequest $request, $modeOfArrivals)
    {
        try {
            ModeOfArrivals::find($modeOfArrivals)->update($request->validated());

            // Get the updated mode of arrival
            $updatedModeOfArrival = ModeOfArrivals::find($modeOfArrivals);

            // Redirect to the view of the updated mode of arrival
            return response()->json(['status' => true, "message" => "Arrival Updated", "redirectTo" => route("mode-of-arrivals.show", $updatedModeOfArrival)]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModeOfArrivals  $modeOfArrivals
     * @return \Illuminate\Http\Response
     */
    public function destroy($modeOfArrivals)
    {
        return ModeOfArrivals::find($modeOfArrivals)->delete();
    }
    public function getArrivalJson(Request $request)
    {
        $search = $request->search;
        $arrivals = ModeOfArrivals::with(['ship'])->when(!empty($search), function ($q) use ($search) {
            $q->where('name_of_ship', 'like', '%' . $search . '%');
        })
        ->get();

        $response = array();
        
        foreach ($arrivals as $arrival) {
            $response[] = array(
                "id" => $arrival?->id,
                "text" => $arrival?->ship?->name_of_ship . " - " . $arrival?->year
            );
        }

        return response()->json($response);
    }
    function getShipFirstDate(Request $request)
    {
        $ship = ModeOfArrivals::findOrFail($request->ship_id);
        return response()->json(
            [
                "mode_of_travel_id" => $ship->id,
                "first_date" => $ship?->date_of_arrival
            ]
        );
    }
}
