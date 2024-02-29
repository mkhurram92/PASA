<?php

namespace App\Http\Controllers;

use App\Models\GlCodesParent;

use Illuminate\Http\Request;

class GlCodesParentController extends Controller
{
    public function index()
    {
        $glCodesParents = GlCodesParent::all();
        
        return view('gl_codes_parent.index', compact('glCodesParents'));
    }

    // Show a single record
    public function show($id)
    {
        $glCodesParent = GlCodesParent::findOrFail($id);
        return view('gl_codes_parent.show', compact('glCodesParent'));
    }

    // Create a new record (show the form)
    public function create()
    {
        return view('gl_codes_parent.create');
    }

    // Store a new record in the database
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // ... other validation rules
        ]);

        // Create a new GlCodesParent instance
        GlCodesParent::create($validatedData);

        // Redirect to the index page or show success message
        return redirect()->route('gl_codes_parent.index');
    }

    // Edit a record (show the form)
    public function edit($id)
    {
        $glCodesParent = GlCodesParent::findOrFail($id);
        return view('gl_codes_parent.edit', compact('glCodesParent'));
    }

    // Update a record in the database
    public function update(Request $request, $id)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // ... other validation rules
        ]);

        // Update the GlCodesParent instance
        $glCodesParent = GlCodesParent::findOrFail($id);
        $glCodesParent->update($validatedData);

        // Redirect to the index page or show success message
        return redirect()->route('gl_codes_parent.index');
    }

    // Delete a record
    public function destroy($id)
    {
        GlCodesParent::destroy($id);

        // Redirect to the index page or show success message
        return redirect()->route('gl_codes_parent.index');
    }
}
