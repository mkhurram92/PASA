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
use App\Models\MembershipStatus;
use App\Models\MembershipType;
use App\Models\States;
use App\Models\Subscription;
use App\Models\Title;
use App\Models\MembersContact;
use App\Models\MembersAddress;
use App\Models\User as ModelsUser;
use App\Models\VolunteerDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMemberRequest;
use App\Models\AncestorData;
use App\Models\SubscriptionPlan;
use App\Models\MemberPedigree;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Hash;
use App\Models\ModeOfArrival;
use App\Models\ModeOfArrivals;
use App\Models\Transaction;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SubscribeMemberController extends Controller
{
    public function __construct() {}
    public function create()
    {
        $data['titles'] = Title::all();
        $data['states'] = States::all();
        $data['membership_status'] = MembershipStatus::all();
        //$data['membership_types'] = MembershipType::all();
        $data['membership_types'] = SubscriptionPlan::all();

        return view('page.members.create', compact('data'));
    }

    public function index(Request $request)
    {
        // Fetch members with related models
        $members = Member::with('subscriptionPlan', 'membershipStatus', 'additionalInfo')->get();

        // Fetch membership type options
        $membershipTypeOptions = SubscriptionPlan::pluck('name', 'id')->toArray(); // Associative array for IDs and names
        $membershipTypeOptions = ['' => ''] + $membershipTypeOptions; // Add an empty option if needed

        // Fetch membership status options
        $membershipStatusOptions = MembershipStatus::pluck('name', 'id')->toArray(); // Associative array for IDs and names
        $membershipStatusOptions = ['' => ''] + $membershipStatusOptions; // Add an empty option if needed

        // Return view with data
        return view('page.members.index', compact('members', 'membershipTypeOptions', 'membershipStatusOptions'));
    }

    public function store(StoreMemberRequest $request)
    {
        try {
            $member = Member::create([
                'title_id' => $request->title,
                'title_detail' => $request->title_detail,
                'family_name' => $request->family_name,
                'given_name' => $request->given_name,
                'preferred_name' => $request->preferred_name,
                'initials' => $request->initials,
                'post_nominal' => $request->post_nominal ?? null,
                //'date_of_birth' => !empty($request->date_of_birth) ? date('Y-m-d', strtotime($request->date_of_birth)) : null,
                'date_of_birth' => $request->date_of_birth, //&& is_numeric($request->date_of_birth) && $request->date_of_birth >= 00 && $request->date_of_birth <= 31) ? (int)$request->date_of_birth : null,
                'month_of_birth' => $request->month_of_birth, //&& is_numeric($request->month_of_birth) && $request->month_of_birth >= 01 && $request->month_of_birth <= 12) ? (int)$request->month_of_birth : null,
                'year_of_birth' => $request->year_of_birth, //&& is_numeric($request->year_of_birth) && $request->year_of_birth >= 1900 && $request->year_of_birth <= 2100) ? (int)$request->year_of_birth : null,
                'username' => $request->username,
                'member_type_id' => $request->member_type_id,
                'member_status_id' => $request->member_status_id,
                'journal' => $request->journal,
            ]);

            $member->address()->updateOrCreate(['member_id' => $member->id], [
                'unit_no' => $request->unit_no,
                'number_street' => $request->number_street,
                'suburb' => $request->city_id,
                'state_id' => $request->county_id,
                'country_id' => $request->country_id,
                'post_code' => $request->post_code,
            ]);
            $member->contact()->updateOrCreate(['member_id' => $member->id], [
                'email' => $request->email,
                'mobile' => $request->mobile,
                'phone' => $request->phone,
                'area_code' => $request->area_code,
            ]);

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

                //'date_membership_approved' => !empty($request->date_membership_approved) ? date('Y-m-d', strtotime($request->date_membership_approved)) : null
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
            return response()->json([
                "status" => true,
                "message" => "Member Created Successfully",
                "redirectTo" => route("members.view-member", ['id' => $member->id])
            ]);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => $e->getMessage()]);
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

        $data['state_name'] = Helper::getState($member?->address?->state);
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);
        $data['membership_types'] = SubscriptionPlan::all();
        $data['membership_status'] = MembershipStatus::all();

        // Check if the membership end date is within one month
        $membershipEndDate = $member?->additionalInfo?->date_membership_end ? Carbon::parse($member->additionalInfo->date_membership_end) : null;
        $currentDate = Carbon::now();
        $oneMonthLater = $currentDate->copy()->addDays(30);

        $showRenewButton = false;

        if ($membershipEndDate) {
            // Log the dates
            //Log::info("Membership End Date: " . $membershipEndDate->toDateString());
            //Log::info("Current Date: " . $currentDate->toDateString());
            //Log::info("One Month Later: " . $oneMonthLater->toDateString());

            // Check if the membership end date is between today and one month later
            if ($membershipEndDate->between($currentDate, $oneMonthLater)) {
                $showRenewButton = true;
            }
        }

        $stripeKey = env('STRIPE_KEY');

        return view('page.members.view-member', compact('member', 'data', 'stripeKey', 'showRenewButton'));
    }


    public function editMember($id)
    {
        $member = Member::find($id);
        $data['titles'] = Title::all();
        $data['state_name'] = Helper::getState($member?->address?->state);
        $data['states'] = States::all();
        $data['membership_status'] = MembershipStatus::all();
        //$data['membership_types'] = MembershipType::all();
        $data['membership_types'] = SubscriptionPlan::all();
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);

        return view('page.members.edit-member', compact('member', 'data'));
    }

    public function memberDetailUpdate(Request $request, $id)
    {
        $needToValidate = [
            'title' => 'required',
            'family_name' => 'required',
            'given_name' => 'required',
            'preferred_name' => 'nullable',
            'username' => 'nullable',
            'date_of_birth' => 'nullable',
            'month_of_birth' => 'nullable',
            "year_of_birth" => 'nullable|regex:/^\d{4}$/',

            'number_street' => 'nullable',
            'suburb' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'post_code' => 'nullable',

            'email' => [
                'nullable',
                'email',
                Rule::unique('members_contacts', 'email')->ignore($id, 'member_id')
            ],
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'journal' => 'required',
        ];

        $validator = Validator::make($request->all(), $needToValidate);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), "values" => $request->all()], 422);
        }

        $member = Member::find($id);
        $oldEmail = $member->contact->email ?? null;
        $newEmail = $request->email;

        $member->title_id = $request->title;
        $member->title_detail = $request->title_detail;
        $member->family_name = $request->family_name;
        $member->given_name = $request->given_name;
        $member->preferred_name = $request->preferred_name;
        $member->initials = $request->initials;
        $member->post_nominal = $request->post_nominal ?? null;
        $member->date_of_birth = $request->date_of_birth;
        $member->month_of_birth = $request->month_of_birth;
        $member->year_of_birth = $request->year_of_birth;

        $member->username = $request->username;
        $member->member_type_id = $request->member_type_id;
        $member->member_status_id = $request->member_status_id;
        $member->journal = $request->journal;

        $member->save();

        $member->address()->updateOrCreate([], [
            'unit_no' => $request->unit_no,
            'number_street' => $request->number_street,
            'suburb' => $request->city_id,
            'state_id' => $request->county_id,
            'country_id' => $request->country_id,
            'post_code' => $request->post_code,
        ]);

        $member->contact()->updateOrCreate([], [
            'email' => $request->email,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'area_code' => $request->area_code,
        ]);

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

        if ($oldEmail !== $newEmail && $newEmail) {
            $user = ModelsUser::where('email', $oldEmail)->first();
            if ($user) {
                $user->email = $newEmail;
                $user->save();
            }
        }

        if (Auth::user()->name == 'Admin') {
            return response()->json([
                "status" => true,
                "message" => "Member Updated successfully",
                "redirectTo" => route("members.view-member", ['id' => $member->id])
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Member Updated successfully",
                "redirectTo" => route("profile")
            ]);
        }
    }

    public function update(Member $member)
    {
        try {
            DB::beginTransaction();

            AdditionalMemberInfos::updateOrCreate(
                ['member_id' => $member->id],
                [
                    'date_membership_approved' => now(),
                    'date_membership_end' => now()->addYear(),
                ]
            );

            $usr = ModelsUser::create([
                "email" => $member->contact->email,
                "password" => $member->password, // Hash the password
                "name" => $member->given_name . " " . $member->family_name,
                "role_id" => 2
            ]);

            $usr->assignRole("user");
            Mail::to($member->contact->email)->send(new ApprovalEmail($member));

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Member Approved Successfully",
                "redirectTo" => route("members.view-member", ['id' => $member->id])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the exception for debugging purposes
            Log::error('Error updating member: ' . $e->getMessage());

            return response()->json([
                "status" => false,
                "message" => "Error updating member",
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function editPedigree($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        return view('page.members.edit-pedigree', ['member' => $member]);
    }

    public function updatePedigree(Request $request, $id)
    {
        $this->validate($request, [
            'pedigree.*.f_name' => 'nullable|string|max:255',
            'pedigree.*.m_name' => 'nullable|string|max:255',
            // Add more validation rules as needed
        ]);

        $member = Member::findOrFail($id);

        $existingPedigreeIds = MemberPedigree::where('member_id', $member->id)->pluck('id')->toArray();

        $updatedPedigreeIds = [];

        foreach ($request->pedigree as $pedigreeData) {
            $pedigreeId = $pedigreeData['id'] ?? null;
            $pedigree = $pedigreeId ? MemberPedigree::find($pedigreeId) : new MemberPedigree();

            if ($pedigree) {
                $pedigree->fill($pedigreeData);
                $pedigree->member_id = $member->id;
                $pedigree->save();

                $updatedPedigreeIds[] = $pedigree->id;
            }
        }

        // Delete any pedigrees that are not in the updated list
        MemberPedigree::where('member_id', $member->id)
            ->whereNotIn('id', $updatedPedigreeIds)
            ->delete();
        if (Auth::user()->name == 'Admin') {
            return response()->json([
                "status" => true,
                "message" => "Pedigree updated successfully",
                "redirectTo" => route("members.view-pedigree", ['id' => $member->id])
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Pedigree updated successfully",
                "redirectTo" => route("profile")
            ]);
        }
    }

    public function addPedigree($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        return view('page.members.add-pedigree', ['member' => $member]);
    }

    public function storePedigree(Request $request, $memberId)
    {
        $this->validate($request, [
            'pedigrees.*.f_name' => 'nullable|string|max:255',
            'pedigrees.*.m_name' => 'nullable|string|max:255',
        ]);

        $member = Member::findOrFail($memberId);

        foreach ($request->pedigrees as $pedigreeData) {
            $pedigreeData['member_id'] = $memberId;
            MemberPedigree::create($pedigreeData);
        }
        return response()->json([
            "status" => true,
            "message" => "Pedigree Added successfully",
            "redirectTo" => route("members.view-pedigree", ['id' => $member->id])
        ]);
    }

    public function viewAncestor($id)
    {
        $member = Member::find($id);
        $ancestors = AncestorData::with(['sourceOfArrival', 'mode_of_travel'])->get();

        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        return view('page.members.view-ancestor', compact('member', 'ancestors'));
    }

    public function addAncestor($id)
    {
        $member = Member::find($id);
        $ancestors = AncestorData::with(['sourceOfArrival', 'mode_of_travel'])->get();

        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        //return view('page.members.add-ancestor', ['member' => $member]);
        return view('page.members.add-ancestor', compact('member', 'ancestors'));
    }

    public function storeAncestor(Request $request, $memberId)
    {
        $request->validate([
            'given_name' => 'required|array',
            'given_name.*' => 'required|exists:ancestor_data,id',
        ]);

        $member = Member::findOrFail($memberId);

        // Loop through the ancestors and attach them to the member
        foreach ($request->given_name as $ancestorId) {
            if ($ancestorId) {
                $member->ancestors()->attach($ancestorId);
            }
        }

        //return redirect()->route('members.show', $member->id)->with('success', 'Ancestors added successfully.');
        return response()->json([
            "status" => true,
            "message" => "Ancestors added successfully",
            "redirectTo" => route("members.view-ancestor", ['id' => $member->id])
        ]);
    }

    public function editAncestors($id)
    {
        $member = Member::with(['ancestors.sourceOfArrival', 'ancestors.mode_of_travel'])->findOrFail($id);
        $ancestors = AncestorData::all();

        return view('page.members.edit_ancestors', compact('member', 'ancestors'));
    }

    public function updateAncestors(Request $request, $memberId)
    {

        $request->validate([
            'given_name' => 'required|array',
            'given_name.*' => 'required|exists:ancestor_data,id',
        ]);

        $member = Member::findOrFail($memberId);

        // First, detach all existing ancestors
        $member->ancestors()->detach();

        // Attach the new set of ancestors
        foreach ($request->given_name as $ancestorId) {
            if ($ancestorId) {
                $member->ancestors()->attach($ancestorId);
            }
        }

        // Return a response indicating success
        return response()->json([
            "status" => true,
            "message" => "Ancestors updated successfully",
            "redirectTo" => route("members.view-ancestor", ['id' => $member->id])
        ]);
    }

    public function getModeOfTravelDate($id)
    {
        try {
            $modeOfArrival = ModeOfArrivals::find($id);

            if ($modeOfArrival) {
                //Log::error('Mode of Arrival not found', ['id' => $modeOfArrival->date_of_arrival]);
                return response()->json(['date_of_arrival' => $modeOfArrival->date_of_arrival]);
            } else {
                //Log::error('Mode of Arrival not found', ['id' => $id]);
                return response()->json(['error' => 'Mode of Arrival not found'], 404);
            }
        } catch (\Exception $e) {
            //Log::error('Error fetching Mode of Arrival', ['exception' => $e]);
            return response()->json(['error' => 'Error fetching data'], 500);
        }
    }

    public function updateRenewalDate(Request $request)
    {
        try {

            $member = AdditionalMemberInfos::where('member_id', $request->memberId)->first();

            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found.']);
            }

            $currentDate = date('Y-m-d');

            if (empty($currentDate)) {
                $currentDate = (new \DateTime())->format('Y-m-d');
            }

            if ($member->date_membership_end) {
                $currentRenewalDate = new \DateTime($member->date_membership_end);
                $currentRenewalDate->modify('+1 year');
            } else {
                $currentRenewalDate = new \DateTime($currentDate);
                $currentRenewalDate->modify('+1 year');
            }

            $member->date_membership_end = $currentRenewalDate->format('Y-m-d');
            $member->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the renewal date.']);
        }
    }
}
