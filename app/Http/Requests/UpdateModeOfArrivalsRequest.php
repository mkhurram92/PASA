<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModeOfArrivalsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "ship_id" => "required|exists:ships,id",
/*            "year" => "required|digits:4",
            "country_id" => "required|exists:countries,id",
            "county_id" => "required|exists:counties,id",
            "city_id" => "required|exists:cities,id",
            "date_of_departure" => "required",
            "arrived_at" => "required|exists:ports,id",
            "date_of_arrival" => "required",
            "ship_commander" => "required",
            "embarkation_number" => "required",
            "notes" => "nullable",
            "ports_of_call" => "required",*/
        ];
    }
    public function messages()
    {
        return [
            "ship_id.required" => "Ship field is required",
            "ship_id.exists" => "Ship Not Found",
/*            "year.required" => "Year field is required",
            "year.digits" => "Invalid Year",
            "country_id.required" => "Country field is required",
            "country_id.exists" => "County Not Found",
            "county_id.required" => "County field is required",
            "county_id.exists" => "County Not Found",
            "city_id.required" => "City field is required",
            "city_id.exists" => "City Not Found",
            "date_of_departure.required" => "Date of Departure field is required",
            "arrived_at.required" => "Arrived At field is required",
            "arrived_at.exists" => "Port Not Found",
            "date_of_arrival.required" => "Date of Arrival field is required",
            "ship_commander.required" => "Ship Commander field is required",
            "embarkation_number.required" => "Embarkation Number field is required",
            "ports_of_call.required" => "Ports of Call field is required",**/
        ];
    }
}
