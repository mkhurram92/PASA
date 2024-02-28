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
      
        return view('page.gl_codes.index', compact('glCodes', 'gl_code_parent', 'gl_code_sub'));
    }

    public function create()
    {
        //$parentGlCodes = GlCodesParent::OrderBy('name')->get();

        //return view('page.gl_codes.create', compact('parentGlCodes'));

        $html = view("models.glcode-create")->render();
        return response()->json(["status" => true, "html" => $html]);

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255', // Adjust the max length as needed
            'parent_id' => 'required|exists:gl_codes,id',
        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'Code name field is required',
            'parent_id.required' => 'Parent code field is required',
            'parent_id.exists' => 'The selected parent code is invalid.',
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
            "redirectTo" => url("gl_codes")
        ]);
    }

    public function edit(GlCode $glCode)
    {

        return view('page.gl_codes.edit', compact('glCode'));
    }

    public function update(Request $request, GlCode $glCode)
    {
        $glCode->update($request->all());

        return redirect()->route('gl_codes.index')->with('success', 'G/L Code updated successfully!');
    }

    public function destroy(GlCode $glCode)
    {
        $glCode->delete();

        return redirect()->route('gl_codes.index')->with('success', 'G/L Code deleted successfully!');
    }
    public function show(GlCode $glCode)
    {
        $html = view("models.glcode-view", compact('glCode'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }
}
