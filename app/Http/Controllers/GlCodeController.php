<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlCode;
use App\Models\GlCodesParent;

class GlCodeController extends Controller
{
    public function index()
    {
        //$glCodes = GlCode::with('glCodesParent')->get();

        $glCodes = GlCode::with('glCodesParent')->get();

        return view('page.gl_codes.index', compact('glCodes'));
    }

    public function create()
    {
        $parentGlCodes = GlCode::whereNull('parent_id')->get();

        return view('page.gl_codes.create', compact('parentGlCodes'));
    }

    public function store(Request $request)
    {
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
