<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Dashboard;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\Gender;
use App\Models\Member;
use App\Models\MemberJunior;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MembershipType;
use App\Models\MemberShipStatus;


class DashboardController extends Controller
{

    public function __construct()
    {
        // $this->middleware(["auth"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.dashbord.dashbord');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDashboardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDashboardRequest  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }

    function profile(Request $request)
    {
        $user = auth()->user();
        //$member = Member::with(['partner_member', 'pedigree', 'ancestor'])->where("email", $user->email)->first();
        $member = Member::with(['partner_member', 'pedigree', 'ancestor', 'contact'])
            ->whereHas('contact', function ($query) use ($user) {
                $query->where('email', $user->email);
            })
            ->first();

        $data['state_name'] = Helper::getState($member?->state);
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);
        $data['membership_types'] = MembershipType::all();
        $data['membership_status'] = MemberShipStatus::all();

        $member_id = $member?->id;
        $juniors = MemberJunior::with(['withGender', 'withSubscription'])->where("member_id", $member_id)->whereNull("member_junior_id")->latest()->get();
        $genders = Gender::get();
        $states = States::get();
        return view("page.profile.index", compact('user', 'juniors', 'member', 'genders', 'states', 'data'));
    }

    function juniors()
    {
        $user = auth()->user();
        //$member = Member::with(['partner_member', 'pedigree', 'ancestor'])->where("email", $user->email)->first();
        $member = Member::with(['partner_member', 'pedigree', 'ancestor', 'contact'])
            ->whereHas('contact', function ($query) use ($user) {
                $query->where('email', $user->email);
            })
            ->first();
        $member_id = $member?->id;
        $juniors = MemberJunior::with(['withGender', 'withSubscription'])->where("member_id", $member_id)->whereNull("member_junior_id")->latest()->get();
        return view("page.profile.juniors", compact('juniors'));
    }

    function partner()
    {
        $user = auth()->user();
        //$member = Member::with(['partner_member', 'pedigree', 'ancestor'])->where("email", $user->email)->first();
        $member = Member::with(['partner_member', 'pedigree', 'ancestor', 'contact'])
            ->whereHas('contact', function ($query) use ($user) {
                $query->where('email', $user->email);
            })
            ->first();

        $member_id = $member?->id;
        $genders = Gender::get();
        $states = States::get();
        return view("page.profile.partner", compact('member', 'genders', 'states'));
    }
}
