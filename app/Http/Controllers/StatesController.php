<?php

namespace App\Http\Controllers;

use App\DataTables\StatesDataTable;
use App\Models\States;
use App\Http\Requests\StoreStatesRequest;
use App\Http\Requests\UpdateStatesRequest;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDataTable $request)
    {
        return $request->render('page.states.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.states-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatesRequest $request)
    {
        States::create($request->validated());

        return response()->json(["status" => true, "message" => "States created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\States  $state
     * @return \Illuminate\Http\Response
     */
    public function show(States $state)
    {
        $html = view("models.states-view", compact('state'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\States  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(States $state)
    {
        $html = view("models.states-update", compact('state'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatesRequest  $request
     * @param  \App\Models\States  $states
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatesRequest $request, $states)
    {
        $state = States::find($states);
        $state->update($request->validated());

        return response()->json(["status" => true, "message" => "States updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\States  $states
     * @return \Illuminate\Http\Response
     */
    public function destroy($states)
    {
        $state = States::find($states);
        $state->delete();
        return response()->json(["status" => true, "message" => "States Deleted Successfully"]);
    }
    public function getStatesJson(Request $request)
    {
        $search = $request->search;
        $states = States::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })
            ->get();

        $response = array();
        foreach ($states as $state) {
            $SouthAustralia = [];
            if (str_replace(" ", "", strtolower($state->name)) == "southaustralia") {
                $SouthAustralia = ["is_selected" => $state->id];
            }
            $response[] = array_merge(array(
                "id" => $state->id,
                "text" => $state->name
            ), $SouthAustralia);
        }

        return response()->json($response);
    }
}
