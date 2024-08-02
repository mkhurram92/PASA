<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\AncestorData;
use Illuminate\Http\Request;

class MemberAncestorController extends Controller
{
    public function index()
    {
        $memberAncestors = Member::with('ancestors')->get();
        $members = Member::all();
        $ancestors = AncestorData::all();

        return view('page.member_ancestors.index', compact('memberAncestors', 'members', 'ancestors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'ancestor_id' => 'required|exists:ancestor_data,id',
        ]);

        $member = Member::findOrFail($request->member_id);
        $member->ancestors()->attach($request->ancestor_id);

        return redirect()->route('page.member_ancestors.index')->with('success', 'Ancestor added successfully.');
    }

    public function destroy($memberId, $ancestorId)
    {
        $member = Member::findOrFail($memberId);
        $member->ancestors()->detach($ancestorId);

        return redirect()->route('page.member_ancestors.index')->with('success', 'Ancestor removed successfully.');
    }
}