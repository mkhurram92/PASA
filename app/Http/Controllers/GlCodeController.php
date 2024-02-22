<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlCode;

class GlCodeController extends Controller
{
    public function index()
    {
        $glCodes = GlCode::with('parentCode')->get();

        return view('page.gl_codes.index', compact('glCodes'));
    }

    public function create()
    {
        // Add logic if needed, e.g., fetching parent G/L codes for dropdown

        return view('page.gl_codes.create');
    }

    public function store(Request $request)
    {
        // Validate the request

        GlCode::create($request->all());

        return redirect()->route('gl-codes.index')->with('success', 'G/L Code created successfully!');
    }

    public function edit(GlCode $glCode)
    {
        // Add logic if needed, e.g., fetching parent G/L codes for dropdown

        return view('page.gl_codes.edit', compact('glCode'));
    }

    public function update(Request $request, GlCode $glCode)
    {
        // Validate the request

        $glCode->update($request->all());

        return redirect()->route('gl-codes.index')->with('success', 'G/L Code updated successfully!');
    }

    public function destroy(GlCode $glCode)
    {
        $glCode->delete();

        return redirect()->route('gl-codes.index')->with('success', 'G/L Code deleted successfully!');
    }
}
