<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use App\Models\Gender;
use App\Models\Member;
use App\Models\MemberAncestor;
use App\Models\ModeOfArrivals;
use App\Models\Ports;
use App\Models\States;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class FriendMemberFormWizard extends Controller
{
    function FriendMemberFormWizard(Request $request)
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
            if ($step == 1 && !isset($data['intent'])) {
                $values['address'] = $data['address'];
                // create payment intent
                $client_secret = PaymentController::createPaymentIntentFriend($values, $level = "friend");
            } elseif ($step == 1 && isset($data['intent'])) {
                $payment_intent_id = $data['intent']['id'];
                $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
                $payment = $stripe->paymentIntents->retrieve(
                    $payment_intent_id,
                    []
                );
                if ($payment->status == "succeeded") {
                    $Member = Member::create([
                        "username" => $values['username'],
                        "password" => $values['password'],
                        "title" => $values['title'],
                        "given_name" => $values['given_name'],
                        "family_name" => $values['family_name'],
                        "preferred_name" => $values['preferred_name'],
                        'date_of_birth' => !empty($values['date_of_birth']) ? date('Y-m-d', strtotime($values['date_of_birth'])) : null,
                        "number_street" => $values['number_street'],
                        "suburb" => $values['suburb'],
                        "state" => $values['state'],
                        "country" => $values['country'],
                        "post_code" => $values['post_code'],
                        "phone" => $values['phone'],
                        "mobile" => $values['mobile'],
                        "delivery" => $values['journal_preferred_delivery'],
                        "member_type" => "FRIEND",
                        "email" => $values['email'],
                        "level" => 5
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
                    // Mail::to($values['email'])->send(new RegisterEmail($Member));
                    return response()->json(['success' => "Friend added", "redirectTo" => route("login")]);
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
        $states = States::get();
        $genders = Gender::get();
        $subsription_plan = SubscriptionPlan::where('name', 'Friend')->first();
        return view("page.friend-member-form-wizard.index", compact('states', 'genders', 'subsription_plan'));
    }
}
