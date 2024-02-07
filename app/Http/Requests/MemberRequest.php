<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            "username" => 'required|unique:members,username',
            "password" => ['required', 'confirmed'],
            "title" => 'required',
            "given_name" => 'required',
            "family_name" => 'required',
            "preferred_name" => 'required',
            "date_of_birth" => 'nullable',
            "number_street" => 'required',
            "suburb" => 'required',
            "state" => 'required',
            "country" => 'required',
            "post_code" => 'required',
            "phone" => 'nullable',
            "mobile" => 'nullable',
            "email" => 'required',
            "delivery" => 'required',
            "gender" => 'nullable',
            "full_name" => 'required',
            "maiden_name" => 'required',
            "place_of_origin" => 'nullable',
            "place_of_arrival" => 'required',
            "name_of_the_ship" => 'required',
            "card_number" => 'required',
            "card_expiry" => 'required',
            "card_cvc" => 'required',
        ];
    }
}
