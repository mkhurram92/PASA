<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncestorSpouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'ancestor_id',
        'marriage_date',
        'marriage_place',
        'spouse_family_name',
        'spouse_given_name',
        'spouse_birth_date',
        'spouse_birth_place',
        'spouse_death_date',
        'spouse_death_place',
    ];

    public function spouse_details()
    {
        return $this->belongsTo(AncestorData::class, 'ancestor_id');
    }

}
