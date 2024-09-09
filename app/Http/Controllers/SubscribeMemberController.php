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
        $members = Member::with([
            'subscriptionPlan',
            'membershipStatus',
            'additionalInfo',
            'contact',
            'address',
            'title',
            'ancestors.mode_of_travel.ship'
        ])->get();

        //dd($members);

        $membershipTypeOptions = SubscriptionPlan::pluck('name', 'name');
        $membershipStatusOptions = MembershipStatus::pluck('name', 'name');

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

            $currentDate = Carbon::now();

            // Format date, month, and year
            $dateMembershipEnd = $currentDate->format('d'); // Two digits for the day
            $monthMembershipEnd = $currentDate->format('m'); // Two digits for the month
            $yearMembershipEnd = $currentDate->format('Y'); // Four digits for the year

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
                'date_membership_end' => $dateMembershipEnd,
                'month_membership_end' => $monthMembershipEnd,
                'year_membership_end' => $yearMembershipEnd,
                //'date_membership_end' => !empty($request->date_membership_end) ? date('Y-m-d', strtotime($request->date_membership_end)) : null,

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
        $user = auth()->user();

        // Check if the logged-in user is viewing their own data
        if ($user->role_id != 1 && $user->member_id != $id) {
            // Redirect back to the user's own pedigree with a flash message
            return redirect()->route('members.view-pedigree', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to view this pedigree.');
        }

        $member = Member::find($id);
        $data['state_name'] = Helper::getState($member?->state);
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);

        return view('page.members.view-pedigree', compact('member', 'data'));
    }

    public function viewMember($id)
    {
        $user = auth()->user();

        // Check if the logged-in user is viewing their own data
        if ($user->role_id != 1 && $user->member_id != $id) {
            // Redirect back or to their own member page with a flash message
            return redirect()->route('members.view-member', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to view this member\'s details.');
        }

        $member = Member::with([
            'ancestors.mode_of_travel.ship',
            'ancestors.localTravelDetails'
        ])->find($id);

        //dd($member);

        $data['state_name'] = Helper::getState($member?->address?->state);
        $data['gender_name'] = Helper::getGender($member?->ancestor?->gender);
        $data['place_of_arrival'] = Helper::getPlaceOfArrival($member?->ancestor?->place_of_arrival);
        $data['name_of_the_ship'] = Helper::getNameofShip($member?->ancestor?->name_of_the_ship);
        $data['membership_types'] = SubscriptionPlan::all();
        $data['membership_status'] = MembershipStatus::all();

        // Retrieve and combine date, month, and year into a Carbon instance
        $membershipEndDate = $member?->additionalInfo?->date_membership_end;
        $membershipEndMonth = $member?->additionalInfo?->month_membership_end;
        $membershipEndYear = $member?->additionalInfo?->year_membership_end;

        $membershipEndDateTime = null;

        if ($membershipEndYear) {
            // Ensure date and month are two digits
            $day = str_pad($membershipEndDate ?? '01', 2, '0', STR_PAD_LEFT);
            $month = str_pad($membershipEndMonth ?? '01', 2, '0', STR_PAD_LEFT);

            // Combine year, month, and date into a single date string
            $dateString = "{$membershipEndYear}-{$month}-{$day}";

            // Parse the date string into a Carbon instance
            $membershipEndDateTime = Carbon::parse($dateString);
        }

        $currentDate = Carbon::now();
        $oneMonthLater = $currentDate->copy()->addDays(30);

        $showRenewButton = false;

        if ($membershipEndDateTime) {
            // Checking if the membership end date is between today and one month later, or if it's in the past
            if ($membershipEndDateTime->between($currentDate, $oneMonthLater) || $membershipEndDateTime->isPast()) {
                $showRenewButton = true;
            }
        }

        $stripeKey = env('STRIPE_KEY');

        return view('page.members.view-member', compact('member', 'data', 'stripeKey', 'showRenewButton'));
    }


    public function editMember($id)
    {
        $user = auth()->user(); // Get the logged-in user

        // Check if the user is trying to access their own member ID, or they are admin
        if ($user->role_id != 1 && $user->member_id != $id) {
            // If the user is not an admin and tries to access another member's page, redirect to their own view-pedigree page
            return redirect()->route('members.view-member', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to edit the details for other member.');
        }

        $member = Member::find($id);
        $data['titles'] = Title::all();
        $data['state_name'] = Helper::getState($member?->address?->state);
        $data['states'] = States::all();
        $data['membership_status'] = MembershipStatus::all();
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
            //'date_membership_end' => !empty($request->date_membership_end) ? date('Y-m-d', strtotime($request->date_membership_end)) : null,
            'date_membership_end' => !empty($request->date_membership_end) ? $request->date_membership_end : null,
            'month_membership_end' => !empty($request->month_membership_end) ? $request->month_membership_end : null,
            'year_membership_end' => !empty($request->year_membership_end) ? $request->year_membership_end : null,
            //'date_membership_approved' => !empty($request->date_membership_approved) ? date('Y-m-d', strtotime($request->date_membership_approved)) : null
            'date_membership_approved' => !empty($request->date_membership_approved) ? $request->date_membership_approved : null,
            'month_membership_approved' => !empty($request->month_membership_approved) ? $request->month_membership_approved : null,
            'year_membership_approved' => !empty($request->year_membership_approved) ? $request->year_membership_approved : null,
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

            $currentDate = Carbon::now(); // Current date
            $nextYearDate = Carbon::create($currentDate->year + 1, 6, 30); // June 30 of the next year

            // Approval date (today's date)
            $dateMembershipApproved = $currentDate->format('d'); // Two digits for the day
            $monthMembershipApproved = $currentDate->format('m'); // Two digits for the month
            $yearMembershipApproved = $currentDate->format('Y'); // Four digits for the year

            // End date (June 30 of the following year)
            $dateMembershipEnd = $nextYearDate->format('d'); // Day 30
            $monthMembershipEnd = $nextYearDate->format('m'); // Month 06 (June)
            $yearMembershipEnd = $nextYearDate->format('Y'); // Year of the following year

            AdditionalMemberInfos::updateOrCreate(
                ['member_id' => $member->id],
                [
                    'date_membership_approved' => $dateMembershipApproved,
                    'month_membership_approved' => $monthMembershipApproved,
                    'year_membership_approved' => $yearMembershipApproved,
                    'date_membership_end' => $dateMembershipEnd,
                    'month_membership_end' => $monthMembershipEnd,
                    'year_membership_end' => $yearMembershipEnd,
                ]
            );

            $usr = ModelsUser::create([
                "member_id" => $member->id,
                "email" => $member->contact->email,
                "password" => $member->password,
                "role_id" => 2
            ]);

            $usr->assignRole("user");
            //Mail::to($member->contact->email)->send(new ApprovalEmail($member));

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Member Approved Successfully",
                "redirectTo" => route("members.view-member", ['id' => $member->id])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error details
            Log::error('Error updating member:', [
                'member_id' => $member->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                "status" => false,
                "message" => "Error updating member",
                "error" => $e->getMessage(),
            ]);
        }
    }


    public function editPedigree($id)
    {
        $user = auth()->user(); // Get the logged-in user

        // Check if the user is trying to access their own member ID, or they are admin
        if ($user->role_id != 1 && $user->member_id != $id) {
            // If the user is not an admin and tries to access another member's page, redirect to their own view-pedigree page
            return redirect()->route('members.view-pedigree', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to edit the pedigree for this member.');
        }

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
        ]);

        $member = Member::findOrFail($id);

        // Check if the pedigree array is empty, and if so, delete all existing pedigrees
        if (empty($request->pedigree)) {
            MemberPedigree::where('member_id', $member->id)->delete();

            return response()->json([
                "status" => true,
                "message" => "All pedigrees deleted successfully",
                "redirectTo" => Auth::user()->name == 'Admin' ? route("members.view-pedigree", ['id' => $member->id]) : route("members.view-member", ['id' => $member->id])
            ]);
        }

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

        return response()->json([
            "status" => true,
            "message" => "Pedigree updated successfully",
            "redirectTo" => Auth::user()->name == 'Admin' ? route("members.view-pedigree", ['id' => $member->id]) : route("members.view-pedigree", ['id' => $member->id])
        ]);
    }

    public function addPedigree($id)
    {
        $user = auth()->user(); // Get the logged-in user

        // Check if the user is trying to access their own member ID, or they are admin
        if ($user->role_id != 1 && $user->member_id != $id) {
            // If the user is not an admin and tries to access another member's page
            return redirect()->route('members.view-pedigree', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to add pedigrees for this member.');
        }

        $member = Member::find($id);

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
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
        $user = auth()->user();

        // Authorization check: ensure the user can only view their own ancestors, unless they are an admin
        if ($user->role_id != 1 && $user->member_id != $id) {
            // Redirect to the user's own ancestors page with a flash message
            return redirect()->route('members.view-ancestor', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to view this member\'s ancestors.');
        }

        $member = Member::find($id);
        $ancestors = AncestorData::with(['sourceOfArrival', 'mode_of_travel'])->get();

        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        return view('page.members.view-ancestor', compact('member', 'ancestors'));
    }

    public function addAncestor($id)
    {
        $user = auth()->user(); // Get the logged-in user

        // Check if the user is trying to access their own member ID, or they are admin
        if ($user->role_id != 1 && $user->member_id != $id) {
            // If the user is not an admin and tries to access another member's page
            return redirect()->route('members.view-ancestor', ['id' => $user->member_id])
                ->with('error', 'You are not authorized to add ancestors for this member.');
        }

        // Find the member by the provided ID
        $member = Member::find($id);

        // Check if the member exists
        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }

        // Retrieve the ancestors' data
        $ancestors = AncestorData::with(['sourceOfArrival', 'mode_of_travel'])->get();

        // If everything is valid, show the add ancestor page for the member
        return view('page.members.add-ancestor', compact('member', 'ancestors'));
    }


    public function storeAncestor(Request $request, $memberId)
    {
        $request->validate([
            'given_name' => 'required|array',
            'given_name.*' => 'required|exists:ancestor_data,id',
        ]);

        $member = Member::findOrFail($memberId);

        foreach ($request->given_name as $ancestorId) {
            if ($ancestorId) {
                $member->ancestors()->attach($ancestorId);
            }
        }

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
            'given_name' => 'array',
            'given_name.*' => 'exists:ancestor_data,id',
        ]);

        $member = Member::findOrFail($memberId);

        // Detach all existing ancestors
        $member->ancestors()->detach();

        // Attach the new set of ancestors if provided
        if (!empty($request->given_name)) {
            foreach ($request->given_name as $ancestorId) {
                if ($ancestorId) {
                    $member->ancestors()->attach($ancestorId);
                }
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
                return response()->json(['date_of_arrival' => $modeOfArrival->date_of_arrival]);
            } else {
                return response()->json(['error' => 'Mode of Arrival not found'], 404);
            }
        } catch (\Exception $e) {
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

            $today = new \DateTime();

            $currentRenewalDate = (clone $today)->modify('+1 year');

            $member->date_membership_end = "30"; // Day
            $member->month_membership_end = "06"; // Month
            $member->year_membership_end = $currentRenewalDate->format('Y'); // Year
            $member->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the renewal date.']);
        }
    }
}
