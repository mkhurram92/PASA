<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShipStatus extends Model
{
    use HasFactory;
    protected $table = 'membership_status';

    protected $fillable = [
        "name"
    ];
}
