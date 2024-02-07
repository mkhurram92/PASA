<?php

namespace App\Http\Controllers;

use App\DataTables\PortsDataTable;
use App\Models\Ports;
use App\Http\Requests\StorePortsRequest;
use App\Http\Requests\UpdatePortsRequest;

class PortsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PortsDataTable $request)
    {
        return $request->render('page.ports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.port-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePortsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePortsRequest $request)
    {
        $port = Ports::create($request->validated());
        return response()->json(["status" => true, "message" => "Port created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ports  $ports
     * @return \Illuminate\Http\Response
     */
    public function show(Ports $port)
    {
        $html = view("models.port-view",compact('port'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ports  $ports
     * @return \Illuminate\Http\Response
     */
    public function edit(Ports $port)
    {
        $html = view("models.port-update", compact('port'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePortsRequest  $request
     * @param  \App\Models\Ports  $ports
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortsRequest $request, $port)
    {
        $port = Ports::find($port)->update($request->validated());
        return response()->json(["status" => true, "message" => "Port updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ports  $ports
     * @return \Illuminate\Http\Response
     */
    public function destroy($port)
    {
        $port = Ports::find($port);
        $port->delete();
        return response()->json(["status" => true, "message" => "Port deleted"]);
    }
}
