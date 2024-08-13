<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeOfArrivalsRequest extends FormRequest
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
            "ship_id"=> "required|exists:ships,id",
            "year"=> "nullable",
            "country_id"=> "nullable|exists:countries,id",
            "county_id"=> "nullable|exists:counties,id",
            "city_id"=> "nullable",
            "date_of_departure"=> "nullable|digits:2",
            "month_of_departure"=> "nullable|digits:2",
            "year_of_departure" =>'nullable|regex:/^\d{4}$/',
            "arrived_at"=> "nullable|exists:ports,id",
            "date_of_arrival"=> "nullable|digits:2",
            "month_of_arrival"=> "nullable|digits:2",
            "year_of_arrival"=> "nullable|regex:/^\d{4}$/",
            "ship_commander"=> "nullable",
            "embarkation_number"=> "nullable",
            "notes"=> "nullable",
            "ports_of_call"=> "nullable",
        ];
    }
    public function messages()
    {
        return [
            "ship_id.required"=>"Ship field is required",
            "ship_id.exists"=>"Ship Not Found",
            //"year" => "Arrival year must be exactly 4 digits or left blank",
            "year_of_arrival"=>"Arrival year must be exactly 4 digits or left blank",
            "year_of_departure"=>"Departure year must be exactly 4 digits or left blank",
        ];
    }
}
