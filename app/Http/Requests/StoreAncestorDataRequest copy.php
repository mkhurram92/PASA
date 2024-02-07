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
        return [
            'gender' => "required|exists:genders,id",
            'ancestor_surname' => Rule::when($this->gender == 1, [
                'required'
            ], ["nullable"]),
            'maiden_surname' => 'nullable',
            'given_name' => 'required',
            'mode_of_travel_native_bith' => 'required|exists:mode_of_arrivals,id',
            'first_date' => 'nullable',
            'date_of_birth' => 'nullable',
            'notes' => 'nullable',
            'occupation' => 'nullable',
            'source_of_arrival' => 'required|exists:source_of_arrivals,id',
        ];
    }

    public function messages()
    {
        return [
            'gender.required' => "Gender field is required",
            'ancestor_surname.required' => "Ancestor Family Name field is required",
            'given_name.required' => "Given name field is required",
            'mode_of_travel_native_bith.required' => "Mode of travel Field is required",
            'mode_of_travel_native_bith.exists' => "Mode of travel Field does not exist",
            'from.required' => "County field is required",
            'from.exists' => "County field does not exist",
            'first_date.required' => "First date field is required",
            'date_of_birth.required' => "Date of birth field is required",
            'occupation.required' => "Occupation field is required",
            'source_of_arrival.required' => "Mode Of Arrival field is required",
            'source_of_arrival.exists' => "Mode Of Arrival field does not exist",
        ];
    }
}
