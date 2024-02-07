<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    // Display all payment types
    public function index()
    {
        $paymentTypes = PaymentType::all();
        return view('payment_types.index', compact('paymentTypes'));
    }

    // Show the form to create a new payment type
    public function create()
    {
        return view('payment_types.create');
    }

    // Store a newly created payment type in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        PaymentType::create($validatedData);

        return redirect()->route('payment_types.index')->with('success', 'Payment type created successfully!');
    }
}
