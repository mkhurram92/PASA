<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            "title" => 'required',
            "family_name" => 'required',
            "given_name" => 'required',
            "preferred_name" => 'required',
            "date_of_birth" => 'nullable',
            "number_street" => 'required',
            "suburb" => 'required',
            "state" => 'required',
            "country" => 'required',
            "post_code" => 'required',
            "username" => 'required|unique:members,username',
            "phone" => 'nullable',
            "mobile" => 'nullable',
            "email" => 'required|email|unique:members_contacts,email',
            'journal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'given_name.required' => 'The given name field is required.',
            'family_name.required' => 'The family name field is required.',
            'preferred_name.required' => 'The preferred name field is required.',
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'number_street.required' => 'The number street field is required.',
            'suburb.required' => 'The suburb field is required.',
            'state.required' => 'The state field is required.',
            'country.required' => 'The country field is required.',
            'post_code.required' => 'The post code field is required.',
            'email.required' => 'The email field is required.',
            'journal' => 'Journal delivery method is required',
        ];
    }
}
