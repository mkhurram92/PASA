<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSourceOfArrivalRequest extends FormRequest
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
            'name' => 'required|unique:source_of_arrivals,name,' . request()->segment(2) . ',id',
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
