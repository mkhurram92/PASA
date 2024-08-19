<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\MemberAncestor;
use App\Models\ModeOfArrivals;
use App\Models\Ports;
use App\Models\States;
use App\Models\MemberPedigree;
use App\Models\MemberShipStatus;
use App\Models\MembershipType;
use App\Models\SubscriptionPlan;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use App\Mail\RegisterEmail;
use App\Models\Member;
use App\Models\MembersAddress;
use App\Models\MembersContact;
use App\Models\Pedigree;
use App\Models\AncestorData;
use App\Models\Subscription;
use App\Http\Controllers\PaymentController;

class MemberFormWizard extends Controller
{
    public function MemberFormWizard(Request $request, $level = null)
    {
        if ($request->isMethod('post')) {
            return $this->handlePostRequest($request, $level);
        }

        return $this->showForm();
    }

    private function handlePostRequest(Request $request, $level)
    {
        $data = $request->all();
        $values = $this->parseFormValues($data['form']);
        $step = $data['step'];

        $validator = $this->validateStep($values);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), "values" => $values], 422);
        }

        if ($step == 3) {
            return $this->handlePaymentStep($data, $values, $level);
        }

        return response()->json(['success' => "Step validated"]);
    }

    private function parseFormValues($form)
    {
        parse_str($form, $values);
        return $values;
    }

    private function validateStep($values)
    {
        $rules = [
            'username' => 'nullable|min:5|unique:members,username',
            'title' => 'required',
            'given_name' => 'nullable',
            'family_name' => 'nullable',
            'preferred_name' => 'nullable',
        ];

        return Validator::make($values, $rules);
    }

    private function handlePaymentStep($data, $values, $level)
    {
        if (!isset($data['intent'])) {
            $values['address'] = $data['address'];
            $client_secret = PaymentController::createPaymentIntentPrimary($values, $level = "primary");

            return response()->json(['success' => "Step validated", 'client_secret' => $client_secret]);
        }

        $payment = $this->retrievePaymentIntent($data['intent']['id']);

        if ($payment->status == "succeeded") {
            return $this->handleSuccessfulPayment($values, $payment);
        }

        $this->updateSubscriptionStatus($data['intent']['id'], 'FAILED', $payment->status);
        return response()->json(['error' => "Payment failed"]);
    }

    private function retrievePaymentIntent($payment_intent_id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        return $stripe->paymentIntents->retrieve($payment_intent_id, []);
    }

    private function handleSuccessfulPayment($values, $payment)
    {
        Log::info('Handling successful payment', ['payment' => $payment]);

        $member = $this->createMember($values);
        if ($member) {
            Log::info('Member created successfully', ['member_id' => $member->id]);

            try {
                $this->createOrUpdateAddress($member->id, $values);

                $this->createOrUpdateContact($member->id, $values);

                $this->handlePedigree($member->id, $values);

                //$this->createOrUpdateAncestor($member->id, $values);
                //Log::info('Ancestor created/updated successfully', ['member_id' => $member->id]);

                //$this->updateSubscriptionStatus($payment->id, 'SUCCESS', $payment->status, $member->id);
                //Log::info('Subscription status updated successfully', ['payment_id' => $payment->id]);

                ///Mail::to($values['email'])->send(new RegisterEmail($member));
                //Log::info('Member registration email sent', ['email' => $values['email']]);

                return response()->json(['success' => "Member added", "redirectTo" => route("login")]);
            } catch (\Exception $e) {
                Log::error('Error during post-payment processing', [
                    'member_id' => $member->id,
                    'error' => $e->getMessage()
                ]);
                return response()->json(['error' => "Failed to complete member registration"]);
            }
        }

        Log::error('Failed to create member');
        return response()->json(['error' => "Failed to create member"]);
    }

    private function createMember($values)
    {
        //Log::info('Creating member', ['values' => $values]);
        return Member::create([
            "username" => $values['username'],
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
    }

    private function createOrUpdateAddress(int $member_id, array $values)
    {
        MembersAddress::updateOrCreate(
            ['member_id' => $member_id],
            [
                'number_street' => $values['number_street'],
                'suburb' => $values['suburb'],
                'state_id' => $values['state'],
                'country_id' => 14,
                'post_code' => $values['post_code']
            ]
        );
    }

    private function createOrUpdateContact(int $member_id, array $values)
    {
        MembersContact::updateOrCreate(
            ['member_id' => $member_id],
            ['email' => $values['email'], 'phone' => $values['phone']]
        );
    }

    private function handlePedigree(int $member_id, array $values)
    {
        //Log::info('Handling pedigree', ['values' => json_encode($values)]);

        if (isset($values['pedigrees']) && is_array($values['pedigrees'])) {
            foreach ($values['pedigrees'] as $index => $pedigree) {
                MemberPedigree::create([
                    'member_id' => $member_id,
                    'pedigree_level' => $index + 1,
                    'pioneer_parents' => $pedigree['pioneer_parents'] ?? null,
                    'full_name' => $values['full_name'],
                    'f_name' => $pedigree['f_name'],
                    'm_name' => $pedigree['m_name'],

                    'date_of_birth' => !empty($pedigree['date_of_birth']) ? date('Y-m-d', strtotime($pedigree['date_of_birth'])) : null,
                    'place_of_birth' => $pedigree['place_of_birth'] ?? null,

                    'date_of_death' => !empty($pedigree['date_of_death']) ? date('Y-m-d', strtotime($pedigree['date_of_death'])) : null,
                    'place_of_death' => $pedigree['place_of_death'] ?? null,

                    'date_of_marriage' => !empty($pedigree['date_of_marriage']) ? date('Y-m-d', strtotime($pedigree['date_of_marriage'])) : null,
                    'place_of_marriage' => $pedigree['place_of_marriage'] ?? null,

                    'm_birth_date' => !empty($pedigree['m_birth_date']) ? date('Y-m-d', strtotime($pedigree['m_birth_date'])) : null,
                    'm_birth_place' => $pedigree['m_birth_place'] ?? null,

                    'm_death_date' => !empty($pedigree['m_death_date']) ? date('Y-m-d', strtotime($pedigree['m_death_date'])) : null,
                    'm_death_place' => $pedigree['m_death_place'] ?? null,
                ]);
            }
        } else {
            Log::error('Pedigrees key not found or not an array', ['values' => json_encode($values)]);
        }
    }

    private function createOrUpdateAncestor(int $member_id, array $values)
    {
        Log::info('Creating or updating ancestor', ['values' => $values]);
        AncestorData::updateOrCreate(
            ['member_id' => $member_id],
            $values['ancestor']
        );
    }

    private function updateSubscriptionStatus($payment_id, $status, $payment_status, $member_id = null)
    {
        //Log::info('Updating subscription status', ['payment_id' => $payment_id, 'status' => $status, 'payment_status' => $payment_status, 'member_id' => $member_id]);
        Subscription::updateOrCreate(
            ['payment_id' => $payment_id],
            ['status' => $status, 'payment_status' => $payment_status, 'member_id' => $member_id]
        );
    }

    private function showForm()
    {
        $ports = Ports::get();
        $states = States::get();
        $voyages = ModeOfArrivals::with(["ship"])->get();
        $genders = Gender::get();
        $titles = Title::all();
        $subsription_plan = SubscriptionPlan::where('name', 'Primary')->first();
        return view("page.member-form-wizard.index", compact('ports', 'voyages', 'states', 'genders', 'subsription_plan', 'titles'));
    }

    public function validateField(Request $request)
    {
        if ($request->has('username')) {
            $validator = Validator::make($request->all(), [
                'username' => 'nullable|min:5|unique:members,username',
            ]);
        } elseif ($request->has('title')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        } elseif ($request->has('year_of_birth')) {
            $validator = Validator::make($request->all(), [
                'year_of_birth' => 'nullable|digits:4|integer|min:1000|max:9999',
            ], [
                'year_of_birth.digits' => 'Year must be exactly 4 digits or left blank.',
            ]);
        } elseif ($request->has('month_of_birth')) {
            $validator = Validator::make($request->all(), [
                'month_of_birth' => 'nullable|digits:2|integer|min:1|max:12',
            ], [
                'month_of_birth.digits' => 'Month must be exactly 2 digits or left blank.',
            ]);
        } elseif ($request->has('date_of_birth')) {
            $validator = Validator::make($request->all(), [
                'date_of_birth' => 'nullable|digits:2|integer|min:1|max:31',
            ], [
                'date_of_birth.digits' => 'Day must be exactly 2 digits or left blank.',
            ]);
        } elseif ($request->has('email')) {
            if ($request->has('email_confirmation')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|confirmed|unique:members_contacts,email',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:members_contacts,email',
                ]);
            }
        } else {
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
