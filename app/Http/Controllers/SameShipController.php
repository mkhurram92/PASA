<?php

namespace App\Http\Controllers;

use App\Models\ModeOfArrivals;
use Illuminate\Http\Request;
use App\Models\AncestorData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SameShipController extends Controller
{
    public function index(Request $request)
    {
        // Fetch mode of arrivals, including ship names and years, ordered by ship name
        $sameship = DB::table('mode_of_arrivals as ma')
            ->select('ma.id', 's.name_of_ship', 'ma.year')
            ->join('ships as s', 's.id', '=', 'ma.ship_id')
            ->orderBy('s.name_of_ship', 'asc')
            ->get();

        // Pass the data to the view
        return view('page.sameship.index', compact('sameship'));
    }

    public function getAncestors(Request $request)
    {
        // Validate the incoming request
        $request->validate(['ship_id' => 'required|integer']);

        // Fetch ancestors based on the selected mode_of_travel_id
        $ancestors = AncestorData::where('mode_of_travel_id', $request->input('ship_id'))->get();

        // Loop through ancestors and fetch all associated member_ids and their names
        foreach ($ancestors as $ancestor) {
            // Fetch all member_ids and names for the current ancestor_id
            $members = DB::table('member_ancestor as ma')
                ->join('members as m', 'ma.member_id', '=', 'm.id')
                ->where('ma.ancestor_id', $ancestor->id)
                ->select('m.id as member_id', 'm.family_name', 'm.given_name')
                ->get();

            // Format member names for display
            $memberNames = $members->map(function ($member) {
                return $member->family_name . ' ' . $member->given_name;
            });

            // Join member names into a string with <br> for new lines
            $ancestor->member_names = $memberNames->implode('<br>');
        }

        // Return the data as JSON
        return response()->json($ancestors);
    }
}
