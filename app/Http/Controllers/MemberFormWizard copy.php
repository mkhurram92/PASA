<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use App\Models\Gender;
use App\Models\Member;
use App\Models\MemberAncestor;
use App\Models\ModeOfArrivals;
use App\Models\Ports;
use App\Models\States;
use App\Models\MemberPedigree;
use App\Models\MemberShipStatus;
use App\Models\MembershipType;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MemberFormWizard extends Controller
{
    function MemberFormWizard(Request $request, $level = null)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            $form = $data['form'];
            parse_str($form, $values);

            $step = $data['step'];
            $needToValidate = [
                'username' => 'nullable|min:5|unique:members,username',
                //'password' => 'required|confirmed|min:5',
                //'email' => 'required|email|confirmed|unique:members,email',
                'title' => 'required',
                'given_name' => 'nullable',
                'family_name' => 'nullable',
                'preferred_name' => 'nullable',
            ];

            $validator = Validator::make($values, $needToValidate);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), "values" => $values], 422);
            }

            if ($step == 3 && !isset($data['intent'])) {
                $values['address'] = $data['address'];
                // create payment intent
                $client_secret = PaymentController::createPaymentIntentPrimary($values, $level = "primary");
            } elseif ($step == 3 && isset($data['intent'])) {
                $payment_intent_id = $data['intent']['id'];
                $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
                $payment = $stripe->paymentIntents->retrieve(
                    $payment_intent_id,
                    []
                );
                if ($payment->status == "succeeded") {
                    $Member = Member::create([
                        "username" => $values['username'],
                        //"password" => $values['password'],
                        "title_id" => $values['title'],
                        "given_name" => $values['given_name'],
                        "family_name" => $values['family_name'],
                        "preferred_name" => $values['preferred_name'],
                        'year_of_birth' => $values['year_of_birth'],
                        'month_of_birth' => $values['month_of_birth'],
                        'date_of_birth' => $values['date_of_birth'],
                        "gender" => $values['gender'],
                        "member_type_id" => 1,
                        "journal" => (int) $values['journal_preferred_delivery'],
                        "member_status_id" => 1,
                    ]);

                    if ($Member?->id) {
                        $Member->address()->updateOrCreate([], [
                            'unit_no' => 1,
                            'number_street' => $values['number_street'],
                            'suburb' => $values['suburb'],
                            'state_id' => $values['state'],
                            'country_id' => 14,
                            'post_code' => $values['post_code'],
                        ]);

                        $Member->contact()->updateOrCreate([], [
                            'email' => $values['email'],
                            'mobile' => $values['mobile'],
                            'phone' => $values['phone'],
                        ]);

                        foreach ($values as $key => $value) {
                            if ($values['pioneer_parents'] == 1) {
                                MemberPedigree::updateOrCreate(['member_id' => $Member->id], [
                                    'full_name' => $values['full_name'],
                                    'pedigree_level' => 0,
                                    'pioneer_parents' => $values['pioneer_parents'],
                                    'f_name' => $values['main_father_name'],
                                    'm_name' => $values['main_mother_name'],

                                    'date_of_birth' => !empty($values['main_father_dob']) ? date('Y-m-d', strtotime($values['main_father_dob'])) : null,
                                    'place_of_birth' => !empty($values['main_father_pob']) ? $values['main_father_pob'] : null,

                                    'date_of_death' => !empty($values['main_father_dod']) ? date('Y-m-d', strtotime($values['main_father_dod'])) : null,
                                    'place_of_death' => !empty($values['main_father_pod']) ? $values['main_father_pod'] : null,

                                    'date_of_marriage' => !empty($values['main_father_dom']) ? date('Y-m-d', strtotime($values['main_father_dom'])) : null,
                                    'place_of_marriage' => !empty($values['main_father_pom']) ? $values['main_father_pom'] : null,

                                    'm_birth_date' => !empty($values['main_mother_dob']) ? date('Y-m-d', strtotime($values['main_mother_dob'])) : null,
                                    'm_birth_place' => !empty($values['main_mother_pob']) ? $values['main_mother_pob'] : null,

                                    'm_death_date' => !empty($values['main_mother_dod']) ? date('Y-m-d', strtotime($values['main_mother_dod'])) : null,
                                    'm_death_place' => !empty($values['main_mother_pod']) ? $values['main_mother_pod'] : null,
                                ]);
                            } else {
                                MemberPedigree::updateOrCreate(['member_id' => $Member->id], [
                                    'full_name' => $values['full_name'],
                                    'pedigree_level' => 0,
                                    'pioneer_parents' => $values['pioneer_parents'],
                                    'f_name' => $values['main_father_name'],
                                    'm_name' => $values['main_mother_name'],

                                    'date_of_birth' => !empty($values['main_father_dob']) ? date('Y-m-d', strtotime($values['main_father_dob'])) : null,
                                    'place_of_birth' => !empty($values['main_father_pob']) ? $values['main_father_pob'] : null,

                                    'date_of_death' => !empty($values['main_father_dod']) ? date('Y-m-d', strtotime($values['main_father_dod'])) : null,
                                    'place_of_death' => !empty($values['main_father_pod']) ? $values['main_father_pod'] : null,

                                    'date_of_marriage' => !empty($values['main_father_dom']) ? date('Y-m-d', strtotime($values['main_father_dom'])) : null,
                                    'place_of_marriage' => !empty($values['main_father_pom']) ? $values['main_father_pom'] : null,

                                    'm_birth_date' => !empty($values['main_mother_dob']) ? date('Y-m-d', strtotime($values['main_mother_dob'])) : null,
                                    'm_birth_place' => !empty($values['main_mother_pob']) ? $values['main_mother_pob'] : null,

                                    'm_death_date' => !empty($values['main_mother_dod']) ? date('Y-m-d', strtotime($values['main_mother_dod'])) : null,
                                    'm_death_place' => !empty($values['main_mother_pod']) ? $values['main_mother_pod'] : null,
                                ]);
                            }
                        }
                        if (isset($values['sub_father_name']) && isset($values['sub_mother_name'])) {
                            $sub_father_name = $values['sub_father_name'];
                            $sub_mother_name = $values['sub_mother_name'];

                            $sub_father_dob = $values['sub_father_dob'];
                            $sub_father_pob = $values['sub_father_pob'];
                            $sub_father_dod = $values['sub_father_dod'];
                            $sub_father_pod = $values['sub_father_pod'];
                            $sub_father_dom = $values['sub_father_dom'];
                            $sub_father_pom = $values['sub_father_pom'];

                            $sub_mother_dob = $values['sub_mother_dob'];
                            $sub_mother_pob = $values['sub_mother_pob'];
                            $sub_mother_dod = $values['sub_mother_dod'];
                            $sub_mother_pod = $values['sub_mother_pod'];

                            if (count($values['pioneer_sub_parents']) > 0) {
                                foreach ($values['pioneer_sub_parents'] as $key => $value) {
                                    if ($value == 1) {
                                        MemberPedigree::create(
                                            [
                                                'member_id' => $Member->id,
                                                'pedigree_level' => $key + 1,
                                                'pioneer_parents' => $value,
                                                'full_name' => $values['full_name'],
                                                'f_name' => $sub_father_name[$key],
                                                'm_name' => $sub_mother_name[$key],

                                                'date_of_birth' => !empty($sub_father_dob[$key]) ? date('Y-m-d', strtotime($sub_father_dob[$key])) : null,
                                                'place_of_birth' => !empty($sub_father_pob[$key]) ? $sub_father_pob[$key] : null,

                                                'date_of_death' => !empty($sub_father_dod[$key]) ? date('Y-m-d', strtotime($sub_father_dod[$key])) : null,
                                                'place_of_death' => !empty($sub_father_pod[$key]) ? $sub_father_pod[$key] : null,

                                                'date_of_marriage' => !empty($sub_father_dom[$key]) ? date('Y-m-d', strtotime($sub_father_dom[$key])) : null,
                                                'place_of_marriage' => !empty($sub_father_pom[$key]) ? $sub_father_pom[$key] : null,

                                                'm_birth_date' => !empty($sub_mother_dob[$key]) ? date('Y-m-d', strtotime($sub_mother_dob[$key])) : null,
                                                'm_birth_place' => !empty($sub_mother_pob[$key]) ? $sub_mother_pob[$key] : null,

                                                'm_death_date' => !empty($sub_mother_dod[$key]) ? date('Y-m-d', strtotime($sub_mother_dod[$key])) : null,
                                                'm_death_place' => !empty($sub_mother_pod[$key]) ? $sub_mother_pod[$key] : null
                                            ]
                                        );
                                    } else {
                                        MemberPedigree::create(
                                            [
                                                'member_id' => $Member->id,
                                                'pedigree_level' => $key + 1,
                                                'pioneer_parents' => $value,
                                                'full_name' => $values['full_name'],
                                                'f_name' => $sub_father_name[$key],
                                                'm_name' => $sub_mother_name[$key],

                                                'date_of_birth' => !empty($sub_father_dob[$key]) ? date('Y-m-d', strtotime($sub_father_dob[$key])) : null,
                                                'place_of_birth' => !empty($sub_father_pob[$key]) ? $sub_father_pob[$key] : null,

                                                'date_of_death' => !empty($sub_father_dod[$key]) ? date('Y-m-d', strtotime($sub_father_dod[$key])) : null,
                                                'place_of_death' => !empty($sub_father_pod[$key]) ? $sub_father_pod[$key] : null,

                                                'date_of_marriage' => !empty($sub_father_dom[$key]) ? date('Y-m-d', strtotime($sub_father_dom[$key])) : null,
                                                'place_of_marriage' => !empty($sub_father_pom[$key]) ? $sub_father_pom[$key] : null,

                                                'm_birth_date' => !empty($sub_mother_dob[$key]) ? date('Y-m-d', strtotime($sub_mother_dob[$key])) : null,
                                                'm_birth_place' => !empty($sub_mother_pob[$key]) ? $sub_mother_pob[$key] : null,

                                                'm_death_date' => !empty($sub_mother_dod[$key]) ? date('Y-m-d', strtotime($sub_mother_dod[$key])) : null,
                                                'm_death_place' => !empty($sub_mother_pod[$key]) ? $sub_mother_pod[$key] : null
                                            ]
                                        );
                                    }
                                }
                            }
                        }
                        MemberAncestor::updateOrCreate(['member_id' => $Member->id], [
                            'gender' => $values['gender'],
                            'full_name' => $values['full_name'],
                            'maiden_name' => isset($values['maiden_name']) ? $values['maiden_name'] : null,
                            'place_of_origin' => $values['place_of_origin'],
                            'place_of_arrival' => $values['place_of_arrival'],
                            'name_of_the_ship' => $values['name_of_the_ship'],
                            //'partner_name' => $values['partner_name'],
                            'date_of_birth' => !empty($values['ancestor_date_of_birth']) ? date('Y-m-d', strtotime($values['ancestor_date_of_birth'])) : null,
                            'date_of_death' => !empty($values['date_of_death']) ? date('Y-m-d', strtotime($values['date_of_death'])) : null,
                        ]);
                        $startDate = date("Y-m-d H:i:s", $payment->created);
                        $endDate = date("Y-m-d H:i:s", strtotime("+1 years", $payment->created));
                        Subscription::where("payment_intent_id", $payment_intent_id)->update([
                            "start_date" => $startDate,
                            "end_date" => $endDate,
                            "user_id" => $Member?->id,
                            "stripe_payment_id" => $payment->id,
                            "status" => "SUCCESS",
                            "stripe_response" => $payment->status
                        ]);
                    }
                    Mail::to($values['email'])->send(new RegisterEmail($Member));
                    return response()->json(['success' => "Member added", "redirectTo" => route("login")]);
                }
                Subscription::where("payment_intent_id", $payment_intent_id)->update([
                    
                    "status" => "FAILED",
                    "stripe_response" => $payment->status
                ]);
                return response()->json(['error' => "Payment failed"]);
            }
            $res = ['success' => "Step validated"];
            if (isset($client_secret) && !empty($client_secret)) {
                $res['client_secret'] = $client_secret;
            }
            return response()->json($res);
        }
        $ports = Ports::get();
        $states = States::get();
        $voyages = ModeOfArrivals::with(["ship"])->get();
        $genders = Gender::get();
        $titles = Title::all();
        $subsription_plan = SubscriptionPlan::where('name', 'Primary')->first();
        return view("page.member-form-wizard.index", compact('ports', 'voyages', 'states', 'genders', 'subsription_plan', 'titles'));
    }
    
    public function validateField(Request $request){
        if($request->has('username')){
            $validator = Validator::make($request->all(),[
                'username' => 'nullable|min:5|unique:members,username',
            ]);
        }
        elseif($request->has('title')){
            $validator = Validator::make($request->all(),[
                'title' => 'required',
            ]);
        }
        elseif($request->has('year_of_birth')){
            $validator = Validator::make($request->all(),[
                'year_of_birth' => 'nullable|digits:4|integer|min:1000|max:9999',
            ],[
                'year_of_birth.digits' => 'Year must be exactly 4 digits or left blank.',
            ]);
        }
        elseif($request->has('month_of_birth')){
            $validator = Validator::make($request->all(),[
                'month_of_birth' => 'nullable|digits:2|integer|min:1|max:12',
            ],[
                'month_of_birth.digits' => 'Month must be exactly 2 digits or left blank.',
            ]);
        }
        elseif($request->has('date_of_birth')){
            $validator = Validator::make($request->all(),[
                'date_of_birth' => 'nullable|digits:2|integer|min:1|max:31',
            ],[
                'date_of_birth.digits' => 'Day must be exactly 2 digits or left blank.',
            ]);
        }
        elseif($request->has('email')){
            if ($request->has('email_confirmation')) {
                $validator = Validator::make($request->all(),[
                    'email' => 'required|email|confirmed|unique:members_contacts,email',
                ]);
            }else{
                $validator = Validator::make($request->all(),[
                    'email' => 'required|email|unique:members_contacts,email',
                ]);
            }
        }
        else{
            return response()->json(['success' => true]);
        }

        // return Validation result
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            return response()->json(['success' => true]);
        }
    }
}
