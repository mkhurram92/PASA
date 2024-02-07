<?php

namespace App\Http\Controllers;

use App\DataTables\RigsDataTable;
use App\Http\Requests\StoreRigRequest;
use App\Http\Requests\UpdateRigRequest;
use App\Models\Rig;

class RigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RigsDataTable $request)
    {
        return $request->render('page.rigs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.rig-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRigRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRigRequest $request)
    {
        $rig = Rig::create($request->validated());
        return response()->json(["status" => true, "message" => "Rig created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rig  $ports
     * @return \Illuminate\Http\Response
     */
    public function show(Rig $rig)
    {
        $html = view("models.rig-view", compact('rig'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rig  $ports
     * @return \Illuminate\Http\Response
     */
    public function edit(Rig $rig)
    {
        $html = view("models.rig-update", compact('rig'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRigRequest  $request
     * @param  \App\Models\Rig  $ports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRigRequest $request, $rig)
    {
        $rig = Rig::find($rig)->update($request->validated());
        return response()->json(["status" => true, "message" => "Rig updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rig  $ports
     * @return \Illuminate\Http\Response
     */
    public function destroy($rig)
    {
        $rig = Rig::find($rig);
        $rig->delete();
        return response()->json(["status" => true, "message" => "Rig deleted"]);
    }
}
