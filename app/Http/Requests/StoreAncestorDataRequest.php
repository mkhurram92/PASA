<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAncestorDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'gender' => 'required|exists:genders,id',
            'ancestor_surname' => 'required|string',
            'given_name' => 'required|string',
            'maiden_surname' => 'nullable',
            'source_of_arrival' => 'nullable',
            'place_of_birth' => 'nullable', 
            'place_of_death' => 'nullable',
            'date_of_birth' => 'nullable',
            'month_of_birth' => 'nullable',
            "year_of_birth" =>'nullable|regex:/^\d{4}$/',
            'date_of_death' => 'nullable',
            'month_of_death' => 'nullable',
            "year_of_death" =>'nullable|regex:/^\d{4}$/',
            'arrival_date_in_sa' => 'nullable|string',
            'evidence_of_arrival' => 'nullable|string',
            'mode_of_arrival_id' => 'nullable|int',
            'marriage_date' =>'nullable',
            'marriage_month' =>'nullable',
            'marriage_year' => 'nullable',
            'marriage_place'=>'nullable',
            'spouse_family_name' =>'nullable',
            'spouse_given_name' => 'nullable',
            'spouse_birth_date' => 'nullable',
            'spouse_birth_month' => 'nullable',
            'spouse_birth_year' => 'nullable',
            'spouse_birth_place' =>'nullable',
            'spouse_death_place' =>'nullable',
            'spouse_death_date' => 'nullable',
            'spouse_death_month' => 'nullable',
            'spouse_death_year' => 'nullable',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'gender.required' => 'Gender field is required',
            'ancestor_surname.required' => 'Pioneer\'s Family Name field is required',
            'ancestor_surname.string' => 'Pioneer\'s Family Name must be a string',
            'given_name.required' => 'Pioneer\'s Given Name field is required',
            'given_name.string' => 'Pioneer\'s Given Name must be a string',
            'source_of_arrival.required' => 'Mode of Travel field is required',
            'year_of_birth' => 'Birth year must be exactly 4 digits or left blank',
            'year_of_death' => 'Death year must be exactly 4 digits or left blank',
        ];

        return $messages;
    }
}
