<?php

namespace App\Http\Controllers;

use App\DataTables\MembershipStatusDataTable;
use Illuminate\Http\Request;
use App\Models\MembershipStatus;
use App\Http\Requests\StoreMembershipStatusRequest;
use App\Http\Requests\UpdateMembershipStatusRequest;

class MembershipStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MembershipStatusDataTable $request)
    {
        $data = MembershipStatus::all();

        return $request->render('page.membership-status.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.membership-status-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipStatusRequest $request)
    {
        $user = MembershipStatus::create([
            'name' => $request->name,
        ]);

        return response()->json(["status" => true, "message" => "Membership Status Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipStatus $membershipStatus)
    {
        $html = view("models.membership-status-view", compact('membershipStatus'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipStatus $membershipStatus)
    {
        $html = view("models.membership-status-update", compact('membershipStatus'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipStatusRequest $request, MembershipStatus $membershipStatus)
    {
        $req = [
            'name' => $request->name,
        ];
        
        $membershipStatus = MembershipStatus::where("id", $membershipStatus->id)->update($req);

        return response()->json(["status" => true, "message" => "Memberhsip Status Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipStatus $membershipStatus)
    {
        $membershipStatus->delete();
        return response()->json(["status" => true, "message" => "Title deleted successfully"]);
    }
}
