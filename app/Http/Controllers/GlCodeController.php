<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlCode;
use App\Models\GlCodesParent;
use Illuminate\Support\Facades\Validator;

class GlCodeController extends Controller
{
    public function index()
    {
        $gl_code_parent = GlCodesParent::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($gl_code_parent, '');

        $gl_code_sub = GlCode::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($gl_code_sub, '');

        $glCodes = GlCode::with('glCodesParent')->get();

        return view('page.gl-codes.index', compact('glCodes', 'gl_code_parent', 'gl_code_sub'));
    }

    public function create()
    {
        $parentGlCodes = GlCodesParent::OrderBy('name')->get();

        return view('page.gl-codes.create', compact('parentGlCodes'));

        //$html = view("models.glcode-create")->render();
        //return response()->json(["status" => true, "html" => $html]);

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255', // Adjust the max length as needed
            'parent_id' => 'required',
        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'Code name field is required',
            'parent_id.required' => 'Parent name field is required',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        // Create a new GlCode instance
        $glCode = new GlCode([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('parent_id'),
        ]);

        $glCode->save();

        return response()->json([
            "status" => true,
            "message" => "GL Code Added Successfully",
            //"redirectTo" => url("gl-codes")
            "redirectTo" => route("gl-codes.index")
        ]);
    }

    public function edit(GlCode $glCode)
    {

        return view('page.gl-codes.edit', compact('glCode'));
    }

    public function update(Request $request, GlCode $glCode)
    {
        $glCode->update($request->all());

        return redirect()->route('gl-codes.index')->with('success', 'G/L Code updated successfully!');
    }

    public function destroy(GlCode $glCode)
    {
        $glCode->delete();

        return redirect()->route('gl-codes.index')->with('success', 'G/L Code deleted successfully!');
    }
}
