<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountiesRequest extends FormRequest
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
            'name' => 'required',
            'country_id' => "required|exists:countries,id"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name field is required",
            "country_id.required" => "Country field is required",
            "country_id.exists" => "Country does not exist",
        ];
    }
}
