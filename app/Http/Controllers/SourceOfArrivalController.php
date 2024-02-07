<?php

namespace App\Http\Controllers;

use App\DataTables\SourceOfArrivalsDataTable;
use App\Http\Requests\StoreSourceOfArrivalRequest;
use App\Http\Requests\UpdateSourceOfArrivalRequest;
use App\Models\SourceOfArrival;
use Illuminate\Http\Request;

class SourceOfArrivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SourceOfArrivalsDataTable $request)
    {
        $data = SourceOfArrival::all();

        return $request->render('page.source-of-arrivals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.source-of-arrival-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSourceOfArrivalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSourceOfArrivalRequest $request)
    {
        SourceOfArrival::create($request->validated());
        return response()->json(['status' => true, "message" => "Arrival created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceOfArrival  $sourceOfArrival
     * @return \Illuminate\Http\Response
     */
    public function show(SourceOfArrival $sourceOfArrival)
    {
        $html = view("models.source-of-arrival-view", compact('sourceOfArrival'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SourceOfArrival  $sourceOfArrival
     * @return \Illuminate\Http\Response
     */
    public function edit(SourceOfArrival $sourceOfArrival)
    {
        $html = view("models.source-of-arrival-update", compact('sourceOfArrival'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSourceOfArrivalRequest  $request
     * @param  \App\Models\SourceOfArrival  $sourceOfArrival
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSourceOfArrivalRequest $request, $sourceOfArrival)
    {
        try {
            SourceOfArrival::find($sourceOfArrival)->update($request->validated());
            return response()->json(['status' => true, "message" => "Arrival Updated"]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourceOfArrival  $sourceOfArrival
     * @return \Illuminate\Http\Response
     */
    public function destroy($sourceOfArrival)
    {
        return SourceOfArrival::find($sourceOfArrival)->delete();
    }
    public function getArrivalJson(Request $request)
    {
        $search = $request->search;
        $arrivals = SourceOfArrival::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->get();

        foreach ($arrivals as $arrival) {
            $response[] = array(
                "id" => $arrival?->id,
                "text" => $arrival?->name
            );
        }

        return response()->json($response);
    }
}
