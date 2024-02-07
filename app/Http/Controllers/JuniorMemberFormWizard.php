<?php

namespace App\Http\Controllers;

use App\Mail\JuniorAddEmail;
use App\Models\Gender;
use App\Models\Member;
use App\Models\MemberJunior;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JuniorMemberFormWizard extends Controller
{
    function JuniorMemberFormWizard(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            $form = $data['form'];
            parse_str($form, $values);

            $step = $data['step'];
            $needToValidate = [
                'given_name' => 'required',
                'family_name' => 'required',
                'preferred_name' => 'required',
                'date_of_birth' => 'nullable',
                'gender' => 'required|exists:genders,id',
                "sibling.name.*" => 'required'
            ];
            $validator = Validator::make($values, $needToValidate);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), "values" => $values], 422);
            }
            if ($step == 2 && !isset($data['intent'])) {
                $values['address'] = $data['address'];
                // create payment intent
                $client_secret = PaymentController::createPaymentIntentJunior($values, $level = "junior");
            } elseif ($step == 2 && isset($data['intent'])) {
                $payment_intent_id = $data['intent']['id'];
                $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
                $payment = $stripe->paymentIntents->retrieve(
                    $payment_intent_id,
                    []
                );
                if ($payment->status == "succeeded") {
                    $loggedInMember = Member::where("email", auth()->user()->email)->first();
                    if ($loggedInMember) {
                        $Member = MemberJunior::create([
                            "given_name" => $values['given_name'],
                            "family_name" => $values['family_name'],
                            "preferred_name" => $values['preferred_name'],
                            'date_of_birth' => !empty($values['date_of_birth']) ? date('Y-m-d', strtotime($values['date_of_birth'])) : null,
                            "gender" => $values['gender'],
                            "an_adult" => true,
                            "member_id" => $loggedInMember->id
                        ]);
                        if (
                            isset($values['sibling'])
                            && $Member?->id
                            && !empty($values['sibling'])
                            && is_array($values['sibling'])
                            && isset($values['sibling']['name'])
                            && isset($values['sibling']['gender'])
                            && count($values['sibling']['name']) == count($values['sibling']['gender'])
                        ) {
                            foreach ($values['sibling']['name'] as $index => $name) {
                                $gender = $values['sibling']['gender'][$index];
                                $date_of_birth = $values['sibling']['date_of_birth'][$index];
                                if (!empty(trim($name)) && !empty(trim($gender))) {
                                    MemberJunior::create([
                                        'given_name' => $name,
                                        'gender' => $gender,
                                        'date_of_birth' => !empty($date_of_birth) ? date('Y-m-d', strtotime($date_of_birth)) : null,
                                        'member_id' => $loggedInMember->id,
                                        'member_junior_id' => $Member->id,
                                    ]);
                                }
                            }
                        }
                        if ($Member?->id) {
                            $startDate = date("Y-m-d H:i:s", $payment->created);
                            $endDate = date("Y-m-d H:i:s", strtotime("+1 years", $payment->created));
                            Subscription::where("payment_intent_id", $payment_intent_id)->where("created_by", auth()->id())->update([
                                "start_date" => $startDate,
                                "end_date" => $endDate,
                                "user_id" => $Member?->id,
                                "stripe_payment_id" => $payment->id,
                                "status" => "SUCCESS",
                                "stripe_response" => $payment->status
                            ]);
                        }
                        $Member['name'] = $loggedInMember->given_name;
                        // Mail::to($loggedInMember->email)->send(new JuniorAddEmail($Member));
                        return response()->json(['success' => "Junior added", "redirectTo" => route("juniors")]);
                    }
                    return response()->json(['error' => "Member not found"]);
                }
                Subscription::where("payment_intent_id", $payment_intent_id)->where("created_by", auth()->id())->update([
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
        $genders = Gender::get();
        $subsription_plan = SubscriptionPlan::where('name', 'Junior')->first();
        return view("page.junior-member-form-wizard.index", compact('genders', 'subsription_plan'));
    }

    function JuniorSiblings(Request $request, $junior)
    {
        $siblings = MemberJunior::where("member_junior_id", $junior)->get();
        $html = view("models.siblings-view", compact('siblings'))->render();
        return response()->json(['html' => $html]);
    }

    function editJuniorSibling(Request $request, $sibling)
    {
        $sibling = MemberJunior::where("id", $sibling)->where("member_id", auth()->id())->first();
        if ($request->method() == "GET") {
            $genders = Gender::get();
            $html = view("models.sibling-update", compact('sibling', 'genders'))->render();
            return response()->json(['html' => $html]);
        }
        $data = $request->all();
        $needToValidate = [
            'given_name' => 'required',
            'gender' => 'required|exists:genders,id',
        ];
        $validator = Validator::make($data, $needToValidate);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $sibling->update($validator->validated());
        return response()->json(["status" => true, 'message' => "Sibling updated", "redirectTo" => false]);
    }
}
