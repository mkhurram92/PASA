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
            } else {
                $this->saveTravelDetails($ancestorData, $validatedData, $request);
            }

            $this->saveAncestorSpouse($ancestorData, $request);

            $filteredData = array_filter($validatedData, function ($value) {
                return !is_null($value);
            });

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Ancestor Details Saved Successfully",
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

    private function saveAncestorSpouse($ancestorData, $request)
    {
        try {
            //Log::info('Saving ancestor spouse data', $request->only(['marriage_date', 'marriage_place', 'spouse_place_of_birth', 'spouse_place_of_death', 'spouse_family_name', 'spouse_given_name', 'spouse_birth_date', 'spouse_death_date']));

            $ancestorSpouse = new AncestorSpouse();
            $ancestorSpouse->ancestor_id = $ancestorData->id;
            $ancestorSpouse->fill($request->only(['marriage_date', 'marriage_place', 'spouse_place_of_birth', 'spouse_place_of_death', 'spouse_family_name', 'spouse_given_name', 'spouse_birth_date', 'spouse_death_date']));
            $ancestorSpouse->save();

            //Log::info('Ancestor spouse data saved successfully', ['ancestor_spouse_id' => $ancestorSpouse->id]);
        } catch (\Exception $e) {
            //Log::error('Error saving ancestor spouse data: ' . $e->getMessage());
            throw $e; // Rethrow the exception to trigger a rollback
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

            // Update the ancestor data
            $ancestorData->update($validatedData);

            // Handle source of arrival logic
            if ($ancestorData->source_of_arrival == 1 || $ancestorData->source_of_arrival == 2) {
                $ancestorData->mode_of_travel_id = $request->input('mode_of_travel_id');
            } else {
                $this->updateTravelDetails($ancestorData, $validatedData, $request);
                $ancestorData->mode_of_travel_id = null;
            }

            $ancestorData->save();

            // Update spouse data
            $this->updateAncestorSpouse($ancestorData, $request);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "AncestorData updated successfully",
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

    private function updateAncestorSpouse($ancestorData, $request)
    {
        try {
            $spouseData = $request->only(['marriage_date', 'marriage_place', 'spouse_place_of_birth', 'spouse_place_of_death', 'spouse_family_name', 'spouse_given_name', 'spouse_birth_date', 'spouse_death_date']);
            Log::info('Updating ancestor spouse data', $spouseData);

            $ancestorSpouse = AncestorSpouse::where('ancestor_id', $ancestorData->id)->first();

            if ($ancestorSpouse) {
                $ancestorSpouse->fill($spouseData);
            } else {
                $ancestorSpouse = new AncestorSpouse($spouseData);
                $ancestorSpouse->ancestor_id = $ancestorData->id;
            }

            $ancestorSpouse->save();

            Log::info('Ancestor spouse data updated successfully', ['ancestor_spouse_id' => $ancestorSpouse->id]);
        } catch (\Exception $e) {
            Log::error('Error updating ancestor spouse data: ' . $e->getMessage());
            throw $e; // Rethrow the exception to trigger a rollback
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
