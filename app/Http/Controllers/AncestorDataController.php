<?php

namespace App\Http\Controllers;

use App\DataTables\AncestorDataDataTable;
use App\Models\AncestorData;
use App\Models\AncestorLocalTravelDetail;
use App\Http\Requests\StoreAncestorDataRequest;
use App\Http\Requests\UpdateAncestorDataRequest;
use App\Models\AncestorInternationalTravelDetail;
use App\Models\AncestorSpouse;
use App\Models\Countries;
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Ship;
use App\Models\SourceOfArrival;
use App\Models\States;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AncestorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AncestorDataDataTable $request)
    {
        $state = States::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($state, '');

        $occupation = Occupation::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($occupation, '');

        $gender = Gender::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($gender, '');

        $country = Countries::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($country, '');

        $ship = Ship::orderBy('name_of_ship', 'asc')->pluck('name_of_ship')->toArray();
        array_unshift($ship, '');

        $source_of_arrivals = SourceOfArrival::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($source_of_arrivals, '');

        $ancestor = AncestorData::with('occupation_relation', 'Gender', 'Ships', 'departureCountry', 'state', 'sourceOfArrival')->get();

        return $request->render('page.ancestor-data.index', compact('ancestor', 'state', 'occupation', 'gender', 'country', 'ship', 'source_of_arrivals'));
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
    /**public function store(StoreAncestorDataRequest $request)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['date_of_birth'])) {
            $validatedData['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validatedData['date_of_birth'])
                ->format('Y-m-d');
        }
        if (isset($validatedData['date_of_death'])) {
            $validatedData['date_of_death'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validatedData['date_of_death'])
                ->format('Y-m-d');
        }

        DB::beginTransaction();

        try {
            // Create AncestorData
            $ancestorData = AncestorData::create($validatedData);

            // Check the radio button selection and set has_spouse accordingly
            if ($request->input('travel_to_sa') === 'yes') {
                $ancestorData->has_spouse = 1;
                $insert_spouse = 1;
            } elseif ($request->input('travel_to_sa') === 'no') {
                $ancestorData->has_spouse = 0;
                $insert_spouse = 0;
            }

            // Save the AncestorData with the updated has_spouse value
            $ancestorData->save();

            if ($insert_spouse == 1) {
                $ancestor_spouse = new AncestorSpouse();
                $ancestor_spouse->ancestor_id = $ancestorData->id;
                $ancestor_spouse->marriage_date = $request->input('marriage_date');
                $ancestor_spouse->spouse_family_name = $request->input('spouse_family_name');
                $ancestor_spouse->spouse_given_name = $request->input('spouse_given_name');
                $ancestor_spouse->spouse_birth_date = $request->input('spouse_date_of_birth');
                $ancestor_spouse->spouse_death_date = $request->input('spouse_date_of_death');

                $ancestor_spouse->save();
            }

            if ($validatedData['source_of_arrival'] == 1 || $validatedData['source_of_arrival'] == 2) {
                $internationalTravelData = new AncestorInternationalTravelDetail();
                $internationalTravelData->ancestor_id = $ancestorData->id;

                // Extracting ship name and year from the selected option
                //$selectedOption = $validatedData['mode_of_travel_native_bith'];
                //list($shipName, $year) = explode(' - ', $selectedOption);
                // Find the ship by name (assuming 'name' is the column in your 'ships' table)
                //$ship = Ship::where('name', $shipName)->first();
                //if ($ship) {
                // If ship is found, save its ID to the internationalTravelData

                $internationalTravelData->ship_id =  1; //$request->input('mode_of_arrival_select2');

                $internationalTravelData->save();
                //}
            } else {


                $localTravelDetailData = new AncestorLocalTravelDetail();
                $localTravelDetailData->ancestor_id = $ancestorData->id;

                if (isset($validatedData['arrival_date_in_sa'])) {
                    $validatedData['arrival_date_in_sa'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validatedData['arrival_date_in_sa'])->format('Y-m-d');

                    $localTravelDetailData->travel_date = $validatedData['arrival_date_in_sa'];
                }

                if (isset($validatedData['evidence_of_arrival'])) {
                    $localTravelDetailData->description = $validatedData['evidence_of_arrival'];
                }

                $localTravelDetailData->save();
            }

            // Commit the transaction
            DB::commit();

            // Return a response indicating success, a message, and a redirect route
            return response()->json([
                "status" => true,
                "message" => "Ancestor Details Saved Successfully",
                "redirectTo" => route("ancestor-data.index")
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction on exception
            DB::rollback();

            // Log the exception for further investigation
            Log::error($e->getMessage());

            // Return a JSON response with an error message
            return response()->json([
                "status" => false,
                "message" => "An error occurred while creating AncestorData. Please try again later.",
            ], 500);
        }
    }**/

    public function store(StoreAncestorDataRequest $request)
    {

        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

            $this->formatDate($validatedData, 'date_of_birth');
            $this->formatDate($validatedData, 'date_of_death');

            $ancestorData = AncestorData::create($validatedData);

            if ($ancestorData->source_of_arrival == 1 || $ancestorData->source_of_arrival == 2) {

                $ancestorData->mode_of_travel_id = $request->input('mode_of_travel_id');

                $ancestorData->save();
            } else { //($ancestorData->source_of_arrival == 3) {
                $this->saveTravelDetails($ancestorData, $validatedData, $request);
            }

            $this->updateHasSpouse($ancestorData, $request);

            if ($ancestorData->has_spouse) {
                $this->saveAncestorSpouse($ancestorData, $request);
            }

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Ancestor Details Saved Successfully",
                //"redirectTo" => route("ancestor-data.index")
                "redirectTo" => url("ancestor-data/{$ancestorData->id}")
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());

            return response()->json([
                "status" => false,
                "message" => "An error occurred while creating AncestorData. Please try again later.",
            ], 500);
        }
    }

    private function formatDate(&$data, $field)
    {
        if (isset($data[$field])) {
            $data[$field] = Carbon::createFromFormat('Y-m-d', $data[$field])->format('Y-m-d');
        }
    }

    private function updateHasSpouse($ancestorData, $request)
    {
        $ancestorData->has_spouse = ($request->input('travel_to_sa') === 'yes') ? 1 : 0;
        $ancestorData->save();
    }

    private function saveAncestorSpouse($ancestorData, $request)
    {
        $ancestorSpouse = new AncestorSpouse();
        $ancestorSpouse->ancestor_id = $ancestorData->id;
        $ancestorSpouse->fill($request->only(['marriage_date', 'spouse_family_name', 'spouse_given_name', 'spouse_birth_date', 'spouse_death_date']));
        $ancestorSpouse->save();
    }

    private function saveTravelDetails($ancestorData, $validatedData, $request)
    {
        $travelDetailData = new AncestorLocalTravelDetail();
        $travelDetailData->ancestor_id = $ancestorData->id;

        if (isset($validatedData['arrival_date_in_sa'])) {
            $travelDetailData->travel_date = Carbon::createFromFormat('Y-m-d', $validatedData['arrival_date_in_sa'])->format('Y-m-d');
        }

        if (isset($validatedData['evidence_of_arrival'])) {
            $travelDetailData->description = $validatedData['evidence_of_arrival'];
        }

        $travelDetailData->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AncestorData  $ancestorData
     * @return \Illuminate\Http\Response
     */
    public function show($ancestorData)
    {
        $ancestor = AncestorData::with(
            [
                'gender',
                'mode_of_travel',
                'occupation_relation',
                'localTravelDetails',
                'spouse_details'
            ]
        )->find($ancestorData);

        //dd($ancestor->localTravelDetails);
        //dd($ancestor?->localTravelDetails?->description);

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
        $ancestor = AncestorData::with(
            [
                'gender',
                'mode_of_travel',
                'occupation_relation',
                'localTravelDetails',
                'spouse_details'
            ]
        )->find($ancestorData);

        //dd($ancestor?->localTravelDetails?->description);

        return view('page.ancestor-data.update', compact('ancestor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAncestorDataRequest  $request
     * @param  \App\Models\AncestorData  $ancestorData
     * @return \Illuminate\Http\Response
     */
    //public function update(UpdateAncestorDataRequest $request, $ancestorData)
    //{
    //    $ancestorData = AncestorData::find($ancestorData);
    //    $ancestorData->update($request->validated());

    //    return response()->json(["status" => true, "message" => "AncestorData updated successfully", "redirectTo" => route("ancestor-data.index")]);
    //}
    public function update(UpdateAncestorDataRequest $request, $ancestorData)
    {
        DB::beginTransaction();

        try {
            $ancestorData = AncestorData::find($ancestorData);

            if (!$ancestorData) {
                return response()->json([
                    "status" => false,
                    "message" => "AncestorData not found",
                ], 404);
            }

            $validatedData = $request->validated();

            $this->formatDate($validatedData, 'date_of_birth');
            $this->formatDate($validatedData, 'date_of_death');

            if (isset($validatedData['travel_to_sa'])) {
                $ancestorData->has_spouse = $validatedData['travel_to_sa'];
            }

            $ancestorData->update($validatedData);

            if ($ancestorData->source_of_arrival == 1 || $ancestorData->source_of_arrival == 2) {
                $ancestorData->mode_of_travel_id = $request->input('mode_of_travel_id');

                $ancestorData->save();
            } else {
                $this->updateTravelDetails($ancestorData, $validatedData, $request);
                $ancestorData->mode_of_travel_id = null;
                $ancestorData->save();
            }

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "AncestorData updated successfully",
                "redirectTo" => route("ancestor-data.index")
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());

            return response()->json([
                "status" => false,
                "message" => "An error occurred while updating AncestorData. Please try again later.",
            ], 500);
        }
    }
    private function updateTravelDetails($ancestorData, $validatedData, $request)
    {
        // Check if a record already exists for the ancestor
        $travelDetailData = AncestorLocalTravelDetail::where('ancestor_id', $ancestorData->id)->first();

        // If no record exists, create a new one
        if (!$travelDetailData) {
            $travelDetailData = new AncestorLocalTravelDetail();
            $travelDetailData->ancestor_id = $ancestorData->id;
        }

        if (isset($validatedData['arrival_date_in_sa'])) {
            $travelDetailData->travel_date = Carbon::createFromFormat('Y-m-d', $validatedData['arrival_date_in_sa'])->format('Y-m-d');
        }

        if (isset($validatedData['evidence_of_arrival'])) {
            $travelDetailData->description = $validatedData['evidence_of_arrival'];
        }

        $travelDetailData->save();
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
