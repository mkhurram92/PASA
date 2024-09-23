<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // Display a listing of the suppliers (optional)
    public function index()
    {
        $suppliers = Supplier::all();
        return view('page.suppliers.index', compact('suppliers'));
    }
}
