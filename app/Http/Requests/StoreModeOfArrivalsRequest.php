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
            "city_id"=> "nullable|exists:cities,id",
            "date_of_departure"=> "nullable|digits:2",
            "month_of_departure"=> "nullable|digits:2",
            "year_of_departure"=> "nullable|digits:4",
            "arrived_at"=> "nullable|exists:ports,id",
            "date_of_arrival"=> "nullable|digits:2",
            "month_of_arrival"=> "nullable|digits:2",
            "year_of_arrival"=> "nullable|digits:4",
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
/*            "year.required"=>"Year field is required",
            "year.digits"=>"Invalid Year",
            "country_id.required"=>"Country field is required",
            "country_id.exists"=> "County Not Found",
            "county_id.required"=>"County field is required",
            "county_id.exists"=> "County Not Found",
            "city_id.required"=>"City field is required",
            "city_id.exists"=> "City Not Found",
            "date_of_departure.required"=>"Date of Departure field is required",
            "arrived_at.required"=>"Arrived At field is required",
            "arrived_at.exists"=>"Port Not Found",
            "date_of_arrival.required"=> "Date of Arrival field is required",
            "ship_commander.required"=>"Ship Commander field is required",
            "embarkation_number.required"=> "Embarkation Number field is required",
            "ports_of_call.required"=>"Ports of Call field is required",*/
        ];
    }
}
