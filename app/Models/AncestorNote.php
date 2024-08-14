<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncestorNote extends Model
{
    use HasFactory;

    protected $table = 'ancestor_notes';

    protected $fillable = [
        'ancestor_id', 'notes', 'birth_details', 'death_details',
    ];

    public function ancestor()
    {
        return $this->belongsTo(AncestorData::class, 'ancestor_id');
    }
}
