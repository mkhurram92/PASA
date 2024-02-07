<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\MemberAncestor;
use App\Models\MemberPedigree;
use Livewire\Component;

class MemberFormWizard extends Component
{
    public $level;
    public $next = 'Next';
    public $previous = 'Previous';
    public $step = 1;
    // Account
    public $username;
    public $email;
    public $email_confirmation;
    public $password;
    public $password_confirmation;

    // Personal 
    public $title = 'Mr.';
    public $given_name;
    public $family_name;
    public $preferred_name;
    public $date_of_birth;
    public $number_street;
    public $suburb;
    public $state;
    public $country = 'Australia';
    public $post_code;
    public $phone;
    public $mobile;
    public $delivery;

    // Ancestor
    public $gender = 'male';
    public $full_name;
    public $maiden_name;
    public $place_of_origin;
    public $place_of_arrival;
    public $name_of_the_ship;

    // Payment
    public $card_number;
    public $card_expiry;
    public $card_cvc;

    // Pedigree
    public $application_pedigree_1 = '', $pedigreefullName_1 = '', $pedigreeMemeberShipId_1 = '', $pedigreeBirthPlace_1 = '';
    public $application_pedigree_2 = '', $pedigreefullName_2 = '', $pedigreeMemeberShipId_2 = '', $pedigreeBirthPlace_2 = '';
    public $application_pedigree_3 = '', $pedigreefullName_3 = '', $pedigreeMemeberShipId_3 = '', $pedigreeBirthPlace_3 = '';
    public $application_pedigree_4 = '', $pedigreefullName_4 = '', $pedigreeMemeberShipId_4 = '', $pedigreeBirthPlace_4 = '';

    // ValidateData
    public $validatedData = array();

    protected $validationAttributes = [
        'pedigreefullName_1' => 'full Name',
        'pedigreefullName_2' => 'full Name',
        'pedigreefullName_3' => 'full Name',
        'pedigreefullName_4' => 'full Name',
        'username' => 'User Name',
    ];
    protected $rules = [
        'username' => 'required|min:5|unique:members,username',
        'password' => 'required|confirmed',
        'email' => 'required|email|unique:members,email',
        'email_confirmation' => 'required|email|same:email',
        'title' => 'required',
        'given_name' => 'required',
        'family_name' => 'required',
        'preferred_name' => 'required',
        'date_of_birth' => 'nullable',
        'number_street' => 'required',
        'suburb' => 'required',
        'state' => 'required',
        'country' => 'required',
        'post_code' => 'required',
        'phone' => 'nullable',
        'mobile' => 'nullable',
        'delivery' => 'required',
        'gender' => 'required',
        'full_name' => 'required',
        'maiden_name' => 'required',
        'place_of_origin' => 'nullable',
        'place_of_arrival' => 'required',
        'name_of_the_ship' => 'required',
        'card_number' => 'required|between:13,19',
        'card_expiry' => 'required',
        'card_cvc' => 'required',
    ];

    public function mount($level)
    {
        $this->level = $level;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.member-form')
            ->layout('layouts.wp');
    }

    public function gotoNext()
    {
        switch ($this->step) {
            case 1:
                $validatedData = $this->validate([
                    'username' => 'required|min:5|unique:members,username',
                    'password' => 'required|confirmed',
                    'email' => 'required|email|unique:members,email',
                    'email_confirmation' => 'required|email|same:email|unique:members,email',
                ]);
                $this->step++;
                $this->next = "Next";
                break;
            case 2:
                $validatedData = $this->validate([
                    'given_name' => 'required',
                    'family_name' => 'required',
                    'preferred_name' => 'required',
                    'date_of_birth' => 'nullable',
                    'number_street' => 'required',
                    'suburb' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'post_code' => 'required',
                    'phone' => 'nullable',
                    'mobile' => 'nullable',
                    'delivery' => 'required',
                ]);
                $this->step++;
                $this->next = "Next";
                break;
            case 3:
                $validatedData = $this->validate([
                    'gender' => 'required',
                    'full_name' => 'required',
                    'maiden_name' => 'required',
                    'place_of_origin' => 'nullable',
                    'place_of_arrival' => 'required',
                    'name_of_the_ship' => 'required',
                ]);
                $this->step++;
                $this->next = "Next";
                break;
            case 4:
                if ($this->application_pedigree_1 != '') {
                    $validatedData = $this->validate([
                        'pedigreefullName_1' => 'required',
                    ]);
                }
                if ($this->application_pedigree_2 != '') {
                    $validatedData = $this->validate([
                        'pedigreefullName_2' => 'required',
                    ]);
                }
                if ($this->application_pedigree_3 != '') {
                    $validatedData = $this->validate([
                        'pedigreefullName_3' => 'required',
                    ]);
                }
                if ($this->application_pedigree_4 != '') {
                    $validatedData = $this->validate([
                        'pedigreefullName_4' => 'required',
                    ]);
                }
                $this->step++;
                $this->next = "Submit";
                break;
            case 5:
                $validatedData = $this->validate([
                    'card_number' => 'required|between:13,19',
                    'card_expiry' => 'required',
                    'card_cvc' => 'required',
                ]);
                try {
                    #"Submit";
                    $member = Member::create([
                        'username' => $this->username,
                        'password' => $this->password,
                        'email' => $this->email,
                        'title' => $this->title,
                        'given_name' => $this->given_name,
                        'family_name' => $this->family_name,
                        'preferred_name' => $this->preferred_name,
                        'date_of_birth' => $this->date_of_birth,
                        'number_street' => $this->number_street,
                        'suburb' => $this->suburb,
                        'state' => $this->state,
                        'country' => $this->country,
                        'post_code' => $this->post_code,
                        'phone' => $this->phone,
                        'mobile' => $this->mobile,
                        'delivery' => $this->delivery,
                        'card_number' => $this->card_number,
                        'card_expiry' => $this->card_expiry,
                        'card_cvc' => $this->card_cvc,
                    ]);
                    $memberAncestor = MemberAncestor::create([
                        'gender' => $this->gender,
                        'full_name' => $this->full_name,
                        'maiden_name' => $this->maiden_name,
                        'place_of_origin' => $this->place_of_origin,
                        'place_of_arrival' => $this->place_of_arrival,
                        'name_of_the_ship' => $this->name_of_the_ship,
                        'member_id' => $member->id,
                    ]);
                    if ($this->application_pedigree_1 != '') {
                        $memberPedigree = MemberPedigree::create([
                            "pedigree" => $this->application_pedigree_1,
                            "full_name" => $this->pedigreefullName_1,
                            "membership_id" => $this->pedigreeMemeberShipId_1,
                            "birth_place" => $this->pedigreeBirthPlace_1,
                            'member_id' => $member->id,
                        ]);
                    }
                    if ($this->application_pedigree_2 != '') {
                        $memberPedigree = MemberPedigree::create([
                            "pedigree" => $this->application_pedigree_2,
                            "full_name" => $this->pedigreefullName_2,
                            "membership_id" => $this->pedigreeMemeberShipId_2,
                            "birth_place" => $this->pedigreeBirthPlace_2,
                            'member_id' => $member->id,
                        ]);
                    }
                    if ($this->application_pedigree_3 != '') {
                        $memberPedigree = MemberPedigree::create([
                            "pedigree" => $this->application_pedigree_3,
                            "full_name" => $this->pedigreefullName_3,
                            "membership_id" => $this->pedigreeMemeberShipId_3,
                            "birth_place" => $this->pedigreeBirthPlace_3,
                            'member_id' => $member->id,
                        ]);
                    }
                    if ($this->application_pedigree_4 != '') {
                        $memberPedigree = MemberPedigree::create([
                            "pedigree" => $this->application_pedigree_4,
                            "full_name" => $this->pedigreefullName_4,
                            "membership_id" => $this->pedigreeMemeberShipId_4,
                            "birth_place" => $this->pedigreeBirthPlace_4,
                            'member_id' => $member->id,
                        ]);
                    }
                    return redirect()->route('member')->with('message', 'Membership subscription submitted!');
                } catch (\Exception $e) {
                }
                break;

            default:
                # code...
                break;
        }
    }
    public function gotoPrevious()
    {
        if ($this->step > 1) {
            $this->step--;
            $this->next = "Next";
        }
    }
}
