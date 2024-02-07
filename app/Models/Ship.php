<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rig;
class Ship extends Model
{
    use HasFactory;
    protected $table = 'ships';
    protected $fillable = [
        'name_of_ship','tonnage','rig'
    ];

    public function rigRelation(){
        return $this->belongsTo(Rig::class,"rig");
    }
}
