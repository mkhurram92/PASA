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
        $glCodesParents = GlCodesParent::orderBy('id', 'asc')->get(['code', 'name']);

        $formattedResults = $glCodesParents->map(function ($glCodeParent) {
            return $glCodeParent->code . ' - ' . $glCodeParent->name;
        })->toArray();

        array_unshift($formattedResults, '');

        $glCodeName = GlCode::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($glCodeName, '');

        $glCodeSubCode = GlCode::selectRaw('CONCAT(parent_id, " - ", code) as parent_code')->get();
        
        $glCodes = GlCode::with('glCodesParent')->get();

        return view('page.gl_codes.index', compact('glCodes', 'formattedResults', 'glCodeName', 'glCodeSubCode'));
    }

    public function create()
    {
        $parentGlCodes = GlCodesParent::OrderBy('code')->get();

        return view('page.gl_codes.create', compact('parentGlCodes'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255', // Adjust the max length as needed
            'parent_id' => 'required|exists:gl_codes,id',
        ];

        // Custom validation messages
        $messages = [
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

        $maxCode = GlCode::where('parent_id', $request->input('parent_id'))->max('code');
        $nextCode = is_numeric($maxCode) ? $maxCode + 10 : 10;

        // Create a new GlCode instance
        $glCode = new GlCode([
            'code' => $nextCode,
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
}
