<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "county_id"
    ];

    public function county(){
        return $this->belongsTo(Counties::class,"county_id");
    }
}
