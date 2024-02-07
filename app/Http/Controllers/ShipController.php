<?php

namespace App\Http\Controllers;

use App\DataTables\ShipDataTable;
use App\Models\Ship;
use App\Http\Requests\StoreShipRequest;
use App\Http\Requests\UpdateShipRequest;
use App\Models\Counties;
use App\Models\Ports;
use App\Models\Rig;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShipDataTable $request)
    {
        $rig = Rig::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($rig, '');

        $data = Ship::with('rigRelation')->get()->map(function ($ship) {
            return [
                'id' => $ship->id,
                'name_of_ship' => $ship->name_of_ship,
                'tonnage' => $ship->tonnage,
                'rigRelation_name' => $ship->rigRelation->name, // Flatten the nested data
                // Add other columns as needed
            ];
        });

        return $request->render('page.ship.index', compact('data','rig'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.ship-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShipRequest $request)
    {
        $Ship = new Ship();
        $Ship->name_of_ship = $request->name_of_ship;
        $Ship->tonnage = $request->tonnage;
        $Ship->rig = $request->rig;
        $Ship->save();

        return response()->json(["status" => true, "message" => "Ship created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        $html = view('models.ship-view', compact('ship'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        $html = view("models.ship-update", compact('ship'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShipRequest  $request
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShipRequest $request, Ship $ship)
    {
        $ship->fill($request->post())->save();
        return response()->json(["status" => true, "message" => "Ship updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {
        $ship->delete();
        return response()->json(["status" => true, "message" => "Ship Deleted Successfully"]);
    }

    public function getRigJson(Request $request)
    {
        $rigs = Rig::when(!empty($request->searchTerm), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->searchTerm . '%');
        })
            ->orderBy('id')
            ->get();
        $response = [];
        foreach ($rigs as $rig) {
            $response[] = [
                'id' => $rig->id,
                'text' => $rig->name,
            ];
        }
        return $response;
    }
    public function getShipJson(Request $request)
    {
        $search = $request->search;
        $ships = Ship::when(!empty($search), function ($q) use ($search) {
            $word_array = explode(" ", $search);
            foreach ($word_array as $word) {
                $q->orWhere('name_of_ship', 'like', '%' . $word . '%');
                $q->orWhere('tonnage', 'like', '%' . $word . '%');
                $q->orWhere('rig', 'like', '%' . $word . '%');
            }
        })->get();

        $response = array();
        foreach ($ships as $ship) {
            $response[] = array(
                "id" => $ship->id,
                "text" => $ship->name_of_ship
            );
        }
        return response()->json($response);
    }
    public function getCountiesJson(Request $request)
    {
        $search = $request->search;

        $counties = Counties::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })
            ->when($request->has('country'), function ($q) use ($request) {
                $q->where("country_id", $request->country);
            })
            ->orderBy('name', 'asc')
            ->get();

        $response = array();
        foreach ($counties as $county) {
            $response[] = array(
                "id" => $county->id,
                "text" => $county->name
            );
        }

        return response()->json($response);
    }

    public function getPortsJson(Request $request)
    {
        $search = $request->search;
        $ports = Ports::when(!empty($search), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->get();

        $response = array();
        foreach ($ports as $port) {
            $response[] = array(
                "id" => $port->id,
                "text" => $port->name
            );
        }

        return response()->json($response);
    }
}
