<?php

namespace App\Http\Controllers;

use App\Models\GlCodesParent;
use App\Models\AccountType;

use Illuminate\Http\Request;

class GlCodesParentController extends Controller
{
    public function index()
    {
        $glCodesParents = GlCodesParent::with('accountType')->get();

        return view('page.gl-codes-parent.index', compact('glCodesParents'));
    }

    // Show a single record

    public function show(GlCodesParent $gl_codes_parent)
    {
        // Load the related AccountType for the gl_codes_parent
        $gl_codes_parent->load('accountType');

        // Render the view with the gl_codes_parent and its related accountType
        $html = view("models.parentgl-view", compact('gl_codes_parent'))->render();

        return response()->json(["status" => true, "html" => $html]);
    }

    // Create a new record (show the form)
    public function create()
    {
        $accountTypes = AccountType::all();

        $html = view("models.parentgl-create", ['accountTypes' => $accountTypes])->render();

        return response()->json(["status" => true, "html" => $html]);

        //return view('gl_codes_parent.create');
    }

    // Store a new record in the database
    public function store(Request $request)
    {
        // Validate input data, including account_type_id
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'account_type_id' => 'required|exists:account_types,id'
        ]);

        // Create a new GlCodesParent instance, including account_type_id
        GlCodesParent::create($validatedData);

        // Return success message with a redirect to the index page
        return response()->json([
            "status" => true,
            "message" => "Account Added Successfully",
            "redirectTo" => route("gl-codes-parent.index")
        ]);
    }

    // Edit a record (show the form)
    public function edit($id)
    {
        $glCodesParent = GlCodesParent::findOrFail($id);
        $accountTypes = AccountType::all(); // Get all account types

        // Render the view with the form pre-filled, including the account types
        $html = view("models.parentgl-update", compact('glCodesParent', 'accountTypes'))->render();

        return response()->json(["status" => true, "html" => $html]);
    }

    // Update a record in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data, including account_type_id
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'account_type_id' => 'required|exists:account_types,id'
        ]);

        // Find the record by its ID
        $glCodesParent = GlCodesParent::findOrFail($id);

        // Update the record with the validated data
        $glCodesParent->update($validatedData);

        // Return a JSON response indicating success
        return response()->json([
            'status' => true,
            'message' => 'Record updated successfully',
            'redirectTo' => route('gl-codes-parent.index')
        ]);
    }

    // Delete a record
    public function destroy($id)
    {
        GlCodesParent::destroy($id);

        // Redirect to the index page or show success message
        return redirect()->route('gl-codes-parent.index');
    }
}
