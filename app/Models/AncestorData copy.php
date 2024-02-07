<?php

namespace App\Models;

use App\Policies\PortsPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncestorData extends Model
{
    use HasFactory;
    protected $table = 'ancestor_data';
    protected $fillable = [
        'ancestor_surname','given_name', 'mode_of_travel_native_bith', 'from', 'first_date', 'res1', 'res2', 'res3', 'date_of_birth', 'b_p_1', 'b_p_2', 'b_p_3', 'notes', 'emigrant_no', 'field1', 'occupation', 'census1841', 'departure_country', 'departure_full_address', 'arrival_country', 'arrival_postcode', 'arrival_full_address', 'source_of_arrival', 'voyage', 'gender', 'departure_city', 'arrival_state'
    ];

    public function mode_of_travel()
    {
        return $this->belongsTo(ModeOfArrivals::class, "mode_of_travel_native_bith");
    }
    public function Voyage()
    {
        return $this->belongsTo(ModeOfArrivals::class, "voyage");
    }
    public function Gender()
    {
        return $this->belongsTo(Gender::class, "gender");
    }
    public function sourceOfArrival()
    {
        return $this->belongsTo(SourceOfArrival::class, "source_of_arrival");
    }

    public function county()
    {
        return $this->belongsTo(Counties::class, "from");
    }
    public function departureCountry()
    {
        return $this->belongsTo(Countries::class, "departure_country");
    }
    public function state()
    {
        return $this->belongsTo(States::class, 'arrival_state');
    }
    public function departureCity()
    {
        return $this->belongsTo(City::class, "departure_city");
    }
    public function arrivalCountry()
    {
        return $this->belongsTo(Countries::class, "arrival_country");
    }

    public function occupation_relation()
    {
        return $this->belongsTo(Occupation::class, "occupation");
    }
    public function Ships()
    {
        return $this->belongsTo(Ship::class, "source_of_arrival");
    }
    public function port(){
        return $this->belongsTo(Ports:: class, "port");
    }
}
