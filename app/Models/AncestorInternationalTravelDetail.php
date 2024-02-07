<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncestorInternationalTravelDetail extends Model
{
    use HasFactory;

    protected $table = 'ancestor_international_travel_details';

    protected $fillable = ['ancestor_id', 'ship_id'];

    public function ancestorInternationalTravel()
    {
        return $this->belongsTo(AncestorData::class, 'ancestor_id');
    }
    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ship_id');
    }
}
