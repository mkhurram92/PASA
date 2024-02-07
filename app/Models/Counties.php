<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counties extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "country_id"
    ];

    public function Country(){
        return $this->belongsTo(Countries::class, "country_id");
    }
}
