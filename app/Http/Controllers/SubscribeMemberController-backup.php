<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Corcel\Model\User;
use App\Helpers\PasswordHash;
use App\Helpers\Helper;

use App\Helpers\Hele;
use App\DataTables\MembersDataTable;
use App\Http\Requests\MemberRequest;
use App\Mail\ApprovalEmail;
use App\Models\AdditionalMemberInfos;
use App\Models\MemberShipStatus;
use App\Models\MembershipType;
use App\Models\States;
use App\Models\Subscription;
use App\Models\Title;
use App\Models\User as ModelsUser;
use App\Models\VolunteerDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;


class SubscribeMemberController extends Controller
{
    public function __construct()
    {
    }
    public function create()
    {
    }

    public function index(Request $request)
    {
        $members = Member::with('membershipType','membershipStatus')->get();
        $membershipTypeOptions = MembershipType::pluck('name')->toArray();
        array_unshift($membershipTypeOptions, '');

        $membershipStatusOptions = MembershipStatus::pluck('name')->toArray();
        array_unshift($membershipStatusOptions, '');

        return view('page.members.index', compact('members', 'membershipTypeOptions', 'membershipStatusOptions'));
    }

    public function store(MemberRequest $request)
    {
        try {
            $member = Member::create($request->validated());
            return response()->json(["status" => true, "message" => "Member created"]);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => "Unable to Created Member"]);
        }
    }
    public function subscribe(MemberRequest $request)
    {
        Member::create($request->validated());
        return response()->json(["status" => true, "message" => "Member created successfully"]);
    }

    public function viewPedigree($id)
    {
        $member = Member::find($id);
        $data['state_name'] = Helper::getState($member?->state);
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);

        return view('page.members.view-pedigree', compact('member', 'data'));
    }

    public function viewMember($id)
    {
        $member = Member::find($id);
        $data['state_name'] = Helper::getState($member?->state);
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);

        return view('page.members.view-member', compact('member', 'data'));
    }

    public function editMember($id)
    {
        $member = Member::find($id);
        $data['titles'] = Title::all();
        $data['state_name'] = Helper::getState($member?->state);
        $data['states'] = States::all();
        $data['membership_status'] = MemberShipStatus::all();
        $data['membership_types'] = MembershipType::all();
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);

        return view('page.members.edit-member', compact('member', 'data'));
    }

    public function memberDetailUpdate(Request $request, $id)
    {
        $needToValidate = [
            'title' => 'required',
            'title_detail' => 'required',
            'family_name' => 'required',
            'given_name' => 'required',
            'preferred_name' => 'required',
            'initials' => 'required',
            'date_of_birth' => 'required',
            'unit_no' => 'required',
            'number_street' => 'required',
            'suburb' => 'required',
            'state' => 'required|exists:states,id',
            'country' => 'required',
            'post_code' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'username' => 'required|min:5',
            'journal' => 'required'
        ];

        $validator = Validator::make($request->all(), $needToValidate);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), "values" => $request->all()], 422);
        }

        $member = Member::find($id);
        $member->title_id = $request->title;
        $member->title_detail = $request->title_detail;
        $member->family_name = $request->family_name;
        $member->given_name = $request->given_name;
        $member->preferred_name = $request->preferred_name;
        $member->initials = $request->initials;
        $member->post_nominal = $request->post_nominal ?? NULL;
        $member->date_of_birth = !empty($request->date_of_birth) ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
        $member->unit_no = $request->unit_no;
        $member->number_street = $request->number_street;
        $member->suburb = $request->suburb;
        $member->state = $request->state;
        $member->post_code = $request->post_code;
        $member->phone = $request->phone;
        $member->mobile = $request->mobile;
        $member->email = $request->email;
        $member->username = $request->username;
        $member->member_type_id = $request->member_type_id;
        $member->member_status_id = $request->member_status_id;
        $member->save();

        AdditionalMemberInfos::updateOrCreate(['member_id' => $member->id], [
            'member_id' => $member->id,
            'membership_number' => $request->membership_number,
            'general_notes' => $request->general_notes,
            'end_status_notes' => $request->end_status_notes,
            'partner_member' => (int)$request->partner_member,
            'volunteer' => (int)$request->volunteer,
            'volunteer_skills_working' => $request->volunteer_skills_working,
            'registration_form_received' => (int)$request->registration_form_received,
            'signed_agreement' => (int)$request->signed_agreement,
            'key_holder' => (int)$request->key_holder,
            'key_held' => $request->key_held,
            'date_membership_end' => !empty($request->date_membership_end) ? date('Y-m-d', strtotime($request->date_membership_end)) : null,
            'date_membership_approved' => !empty($request->date_membership_approved) ? date('Y-m-d', strtotime($request->date_membership_approved)) : null
        ]);
        $volunteerEnable = AdditionalMemberInfos::where('member_id', $member->id)->first();
        if ($volunteerEnable && $volunteerEnable->volunteer == 1) {
            VolunteerDetail::updateOrCreate(['member_id' => $member->id], [
                'member_id' => $member->id,
                'experience' => $request->experience,
                'health_issues' => $request->health_issues,
                'contact' => $request->contact,
                'skills' => $request->skills,
                'availability' => $request->availability
            ]);
        }
        return response()->json(["status" => true, "message" => "Member Updated successfully", "redirectTo" => route("members.index")]);
    }

    public function update(Member $member)
    {
        $member->update(['approved_at' => now()]);

        $usr = ModelsUser::create([
            "email" => $member->email,
            "password" => $member->password,
            "name" => $member->given_name . " " . $member->family_name
        ]);
        $get_subscription = Subscription::where('user_id', $member->id)->first();
        $get_subscription->update(['created_by' => $usr->id]);
        $usr->assignRole("user");
        // Mail::to($member->email)->send(new ApprovalEmail($member));

        return response()->json(["status" => true, "message" => "Member Approved successfully", "redirectTo" => route("members.index")]);
    }
}
