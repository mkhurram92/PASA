<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use App\Models\Gender;
use App\Models\Member;
use App\Models\States;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PartnerMemberFormWizard extends Controller
{
    function PartnerMemberFormWizard(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            $form = $data['form'];
            parse_str($form, $values);

            $step = $data['step'];
            $needToValidate = [
                'username' => 'required|min:5|unique:members,username',
                'password' => 'required|confirmed|min:5',
                'email' => 'required|email|confirmed|unique:members,email',
                'title' => 'required',
                'given_name' => 'required',
                'family_name' => 'required',
                'preferred_name' => 'required',
                'date_of_birth' => 'nullable',
                'gender' => 'required|exists:genders,id',
                'number_street' => 'required',
                'suburb' => 'required',
                'state' => 'required|exists:states,id',
                'country' => 'required',
                'post_code' => 'required',
                'phone' => 'nullable',
                'mobile' => 'nullable',
            ];
            $validator = Validator::make($values, $needToValidate);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), "values" => $values], 422);
            }
            if ($step == 0) {
                // create payment intent
                $client_secret = PaymentController::createPaymentIntent($values, $level = "parter");
            }
            if ($step == 1) {
                $payment_intent = Subscription::wherecreatedBy(auth()->id())->first();
                $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
                $payment = $stripe->paymentIntents->retrieve(
                    $payment_intent->payment_intent_id,
                    []
                );
                if ($payment->status == "succeeded") {
                    $loggedInMember = Member::where("email", auth()->user()->email)->first();
                    if ($loggedInMember) {
                        $Member = Member::create([
                            "username" => $values['username'],
                            "password" => $values['password'],
                            "title" => $values['title'],
                            "given_name" => $values['given_name'],
                            "family_name" => $values['family_name'],
                            "preferred_name" => $values['preferred_name'],
                            'date_of_birth' => !empty($values['date_of_birth']) ? date('Y-m-d', strtotime($values['date_of_birth'])) : null,
                            "gender" => $values['gender'],
                            "number_street" => $values['number_street'],
                            "suburb" => $values['suburb'],
                            "state" => $values['state'],
                            "country" => $values['country'],
                            "post_code" => $values['post_code'],
                            "phone" => $values['phone'],
                            "mobile" => $values['mobile'],
                            "email" => $values['email'],
                            "member_type" => "PARTNER",
                            "delivery" => $values['journal_preferred_delivery'],
                        ]);
                        $loggedInMember->update(["partner_id" => $Member->id]);
                        // Mail::to($loggedInMember->email)->send(new RegisterEmail($Member));
                        return response()->json(['success' => "Partner added", "redirectTo" => route("profile")]);
                    }
                    return response()->json(['error' => "Member not found"]);
                }
                return response()->json(['error' => "Payment error"]);
            }
            $res = ['success' => "Step validated"];
            if (isset($client_secret) && !empty($client_secret)) {
                $res['client_secret'] = $client_secret;
            }
            return response()->json($res);
        }
        $genders = Gender::get();
        $states = States::get();
        $subsription_plan = SubscriptionPlan::where('name', 'Partner')->first();
        return view("page.partner-member-form-wizard.index", compact('genders', 'states', 'subsription_plan'));
    }

    function UpdatePartnerMemberFormWizard(Request $request)
    {
        $data = $request->all();
        $loggedInMember = Member::where("email", auth()->user()->email)->first();
        $partner = $loggedInMember->partner_member;
        $needToValidate = [
            'username' => 'required|min:5|unique:members,username,' . $partner?->id . ',id',
            'password' => 'nullable|confirmed|min:5',
            'email' => 'required|email|confirmed|unique:members,email,' . $partner?->id . ',id',
            'title' => 'required',
            'given_name' => 'required',
            'family_name' => 'required',
            'preferred_name' => 'required',
            'date_of_birth' => 'nullable',
            'gender' => 'required|exists:genders,id',
            'number_street' => 'required',
            'suburb' => 'required',
            'state' => 'required|exists:states,id',
            'country' => 'required',
            'post_code' => 'required',
            'phone' => 'nullable',
            'mobile' => 'nullable',
        ];
        $validator = Validator::make($data, $needToValidate);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        if (empty($values['password'])) {
            unset($validated['password']);
        }
        $partner->update($validated);
        return response()->json(["status" => true, 'message' => "Partner updated", "redirectTo" => route("profile")]);
    }
}
