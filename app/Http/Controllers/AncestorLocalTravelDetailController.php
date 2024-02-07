<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AncestorLocalTravelDetail;


class AncestorLocalTravelDetailController extends Controller
{
    public function index()
    {
        // Fetch all AncestorLocalTravelDetails and pass them to the view
        $ancestorLocalTravelDetails = AncestorLocalTravelDetail::all();
        return view('ancestorLocalTravelDetails.index', compact('ancestorLocalTravelDetails'));
    }

    public function create()
    {
        // Show the form to create a new AncestorLocalTravelDetail
        return view('ancestorLocalTravelDetails.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'ancestor_id' => 'required',
            'travel_date' => 'required',
            'description' => 'required',
        ]);

        // Create a new AncestorLocalTravelDetail
        AncestorLocalTravelDetail::create($validatedData);

        // Redirect to the index page or show a success message
        return redirect()->route('ancestor-local-travel-details.index')->with('success', 'Ancestor Local Travel Detail Saved Successfully');
    }
}
