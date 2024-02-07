<?php

namespace App\Http\Controllers;

use App\DataTables\OccupationsDataTable;
use App\Http\Requests\StoreOccupationRequest;
use App\Http\Requests\UpdateOccupationRequest;
use App\Models\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OccupationsDataTable $request)
    {
        $data = Occupation::all();

        return $request->render('page.occupations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.occupation-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOccupationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOccupationRequest $request)
    {
        $occupation = Occupation::create($request->validated());
        return response()->json(["status" => true, "message" => "Occupation created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupation  $ports
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        $html = view("models.occupation-view", compact('occupation'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupation  $ports
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation)
    {
        $html = view("models.occupation-update", compact('occupation'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOccupationRequest  $request
     * @param  \App\Models\Occupation  $ports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOccupationRequest $request, $occupation)
    {
        $occupation = Occupation::find($occupation)->update($request->validated());
        return response()->json(["status" => true, "message" => "Occupation updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupation  $ports
     * @return \Illuminate\Http\Response
     */
    public function destroy($occupation)
    {
        $occupation = Occupation::find($occupation);
        $occupation->delete();
        return response()->json(["status" => true, "message" => "Occupation deleted"]);
    }

    public function getOccupationJson(Request $request)
    {
        $search = $request->search;
        $occupations = Occupation::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->get();

        $response = array();
        foreach ($occupations as $occupation) {
            $response[] = array(
                "id" => $occupation->id,
                "text" => $occupation->name
            );
        }

        return response()->json($response);
    }
}
