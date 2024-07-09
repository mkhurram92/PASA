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

        $gender_name = Gender::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($gender_name, '');

        $country = Countries::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($country, '');

        $ship = Ship::orderBy('name_of_ship', 'asc')->pluck('name_of_ship')->toArray();
        array_unshift($ship, '');

        $source_of_arrivals = SourceOfArrival::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($source_of_arrivals, '');

        $ancestor = AncestorData::with('occupation_relation', 'Gender', 'Ships', 'departureCountry', 'state', 'sourceOfArrival')->get();

        return $request->render('page.ancestor-data.index', compact('ancestor', 'state', 'occupation', 'gender_name', 'country', 'ship', 'source_of_arrivals'));
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
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

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

            $filteredData = array_filter($validatedData, function ($value) {
                return !is_null($value);
            });

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


    private function updateAncestorSpouse($ancestorData, $request)
    {
        // Find the existing AncestorSpouse record based on the ancestor ID
        $ancestorSpouse = AncestorSpouse::where('ancestor_id', $ancestorData->id)->first();

        if ($ancestorSpouse) {
            // Update the existing record with the new data
            $ancestorSpouse->fill($request->only(['marriage_date', 'spouse_family_name', 'spouse_given_name', 'spouse_birth_date', 'spouse_death_date']));
            $ancestorSpouse->save();
        } else {
            // Create a new record
            AncestorSpouse::create([
                'ancestor_id' => $ancestorData->id,
                'marriage_date' => $request->input('marriage_date'),
                'spouse_family_name' => $request->input('spouse_family_name'),
                'spouse_given_name' => $request->input('spouse_given_name'),
                'spouse_birth_date' => $request->input('spouse_birth_date'),
                'spouse_death_date' => $request->input('spouse_death_date'),
            ]);
        }
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

            //this->formatDate($validatedData, 'date_of_birth');
            //$this->formatDate($validatedData, 'date_of_death');

            if (isset($validatedData['travel_to_sa'])) {
                $ancestorData->has_spouse = $validatedData['travel_to_sa'];
            }

            //$filteredData = array_filter($validatedData, function ($value) {
            //    return !is_null($value);
            //});

            $ancestorData->update($validatedData);

            if ($ancestorData->source_of_arrival == 1 || $ancestorData->source_of_arrival == 2) {

                $ancestorData->mode_of_travel_id = $request->input('mode_of_travel_id');
            } else {
                $this->updateTravelDetails($ancestorData, $validatedData, $request);

                $ancestorData->mode_of_travel_id = null;
            }

            $filteredData = array_filter($validatedData, function ($value) {
                return !is_null($value);
            });

            $ancestorData->save();

            if (isset($validatedData['travel_to_sa'])) {

                $this->updateAncestorSpouse($ancestorData, $request);
            }

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "AncestorData updated successfully",
                //"redirectTo" => route("ancestor-data.index")
                "redirectTo" => url("ancestor-data/{$ancestorData->id}")
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
