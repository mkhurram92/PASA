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
        'marriage_month',
        'marriage_year',
        'marriage_place',
        'spouse_family_name',
        'spouse_given_name',
        'spouse_birth_date',
        'spouse_birth_month',
        'spouse_birth_year',
        'spouse_birth_place',
        'spouse_death_date',
        'spouse_death_month',
        'spouse_death_year',
        'spouse_death_place',
    ];

    public function spouse_details()
    {
        return $this->belongsTo(AncestorData::class, 'ancestor_id');
    }

}
