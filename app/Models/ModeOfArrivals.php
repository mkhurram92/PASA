<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ModeOfArrivals extends Model
{
    use HasFactory;

    protected $fillable = [
        "ship_id",
        "year",
        "date_of_departure",
        "arrived_at",
        "date_of_arrival",
        "ship_commander",
        "embarkation_number",
        "notes",
        "ports_of_call",
        "country_id",
        "county_id",
        "city_id",
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class, "ship_id");
    }

    public function port()
    {
        return $this->belongsTo(Ports::class, "arrived_at");
    }
    public function country()
    {
        return $this->belongsTo(Countries::class, "country_id");
    }
    public function county()
    {
        return $this->belongsTo(Counties::class, "county_id");
    }
    public function city()
    {
        return $this->belongsTo(City::class, "city_id");
    }
    public function setDateOfDepartureAttribute($date_of_departure)
    {
        $carbonDate = Carbon::createFromFormat('m/d/Y', $date_of_departure);
        $formattedDate = $carbonDate->format('Y-m-d');
        $this->attributes['date_of_departure'] = $formattedDate;
    }

    public function setDateOfArrivalAttribute($date_of_arrival)
    {
        $carbonDate = Carbon::createFromFormat('m/d/Y', $date_of_arrival);
        $formattedDate = $carbonDate->format('Y-m-d');
        $this->attributes['date_of_arrival'] = $formattedDate;
    }

    public function getDateOfDepartureAttribute($date_of_departure)
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $date_of_departure);
        $formattedDate = $carbonDate->format('m/d/Y');
        return $formattedDate;
    }

    public function getDateOfArrivalAttribute($date_of_arrival)
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $date_of_arrival);
        $formattedDate = $carbonDate->format('m/d/Y');
        return $formattedDate;
    }
}
