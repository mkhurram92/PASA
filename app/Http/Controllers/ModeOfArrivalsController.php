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
        try {
            $data = $request->validated();

            // Filter out null values
            $filteredData = array_filter($data, function ($value) {
                return !is_null($value);
            });

            ModeOfArrivals::create($filteredData);

            return response()->json([
                "status" => true,
                "message" => "Journey Created Successfully",
                "redirectTo" => route("mode-of-arrivals.index")
            ]);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => $e->getMessage()]);
        }
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
            //    return response()->json(['status' => true, "message" => "Arrival Updated", "redirectTo" => route("mode-of-arrivals.show", $updatedModeOfArrival)]);
            //} catch (\Throwable $th) {
            //    return response()->json(['status' => false]);
            //}

            return response()->json(
                [
                    "status" => true,
                    "message" => "Journey Updated Successfully",
                    "redirectTo" => route("mode-of-arrivals.show", $updatedModeOfArrival)
                ]
            );
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => $e->getMessage()]);
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
/**    public function getArrivalJson(Request $request)
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
**/
    function getShipFirstDate(Request $request)
    {
        $ship = ModeOfArrivals::findOrFail($request->ship_id);
        $dateOfArrival = $ship->date_of_arrival;
        $monthOfArrival = $ship->month_of_arrival;
        $yearOfArrival = $ship->year_of_arrival;

        // Convert to integers if not null
        $dateOfArrival = is_null($dateOfArrival) ? null : intval($dateOfArrival);
        $monthOfArrival = is_null($monthOfArrival) ? null : intval($monthOfArrival);
        $yearOfArrival = is_null($yearOfArrival) ? null : intval($yearOfArrival);

        // Debugging output
        //Log::debug("dateOfArrival: " . json_encode($dateOfArrival));
        //Log::debug("monthOfArrival: " . json_encode($monthOfArrival));
        //Log::debug("yearOfArrival: " . json_encode($yearOfArrival));

        if (is_null($yearOfArrival) && is_null($monthOfArrival) && is_null($dateOfArrival)) {
            $firstDate = "Unknown";
        } elseif (!is_null($yearOfArrival) && is_null($monthOfArrival) && is_null($dateOfArrival)) {
            $firstDate = $yearOfArrival;
        } elseif (!is_null($yearOfArrival) && !is_null($monthOfArrival) && is_null($dateOfArrival)) {
            $firstDate = $yearOfArrival . '-' . str_pad($monthOfArrival, 2, '0', STR_PAD_LEFT);
        } elseif (!is_null($yearOfArrival) && !is_null($monthOfArrival) && !is_null($dateOfArrival)) {
            $firstDate = $yearOfArrival . '-' . str_pad($monthOfArrival, 2, '0', STR_PAD_LEFT) . '-' . str_pad($dateOfArrival, 2, '0', STR_PAD_LEFT);
        } else {
            $firstDate = "Unknown";
        }

        // Debugging output
        //Log::debug("firstDate: " . json_encode($firstDate));

        return response()->json(
            [
                "mode_of_travel_id" => $ship->id,
                "first_date" => $firstDate
            ]
        );
    }
    public function getArrivalJson(Request $request)
    {
        $search = $request->search;
        $arrivals = ModeOfArrivals::with('ship')
            ->when(!empty($search), function ($q) use ($search) {
                $q->whereHas('ship', function ($query) use ($search) {
                    $query->where('name_of_ship', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $response = array();

        foreach ($arrivals as $arrival) {
            $response[] = array(
                "id" => $arrival->id,
                "text" => $arrival->ship->name_of_ship . " - " . $arrival->year
            );
        }

        return response()->json($response);
    }
}
