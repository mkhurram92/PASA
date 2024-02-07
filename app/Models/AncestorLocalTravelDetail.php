<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncestorLocalTravelDetail extends Model
{
    use HasFactory;
    protected $table = 'ancestor_local_travel_details';
    protected $fillable = [
        'ancestor_id', 'travel_date', 'description'
    ];

    public function ancestorLocalTravel()
    {
        return $this->belongsTo(AncestorData::class, 'ancestor_id');
    }
}
