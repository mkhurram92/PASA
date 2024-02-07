<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSourceOfArrivalRequest extends FormRequest
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
            'name' => 'required|max:255|unique:source_of_arrivals,name',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name field is required",
            "name.unique" => "Name is already taken",
            "name.max" => "Name field must be at least 255 characters",
        ];
    }
}
