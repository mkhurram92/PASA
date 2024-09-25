<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Requests\StoreSupplierRequest;

class SupplierController extends Controller
{
    // Display a listing of the suppliers (optional)
    public function index()
    {
        $suppliers = Supplier::all();
        return view('page.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $html = view("models.supplier-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        return response()->json(["status" => true, "message" => "Supplier created", "redirectTo" => route("suppliers.index")]);
    }

    public function show(Supplier $supplier)
    {
        $html = view("models.supplier-view", compact('supplier'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }
    public function edit(Supplier $supplier)
    {
        $html = view("models.supplier-update", compact('supplier'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }
    public function update(UpdateSupplierRequest $request, $rig)
    {
        $supplier = Supplier::find($rig)->update($request->validated());
        return response()->json(["status" => true, "message" => "Supplier Updated", "redirectTo" => route("suppliers.index")]);
    }
}
