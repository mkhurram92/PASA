<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerDetail extends Model
{
    use HasFactory;
    protected $table = 'volunteer_details';
    protected $fillable = [
        "member_id",
        "experience",
        "health_issues",
        "contact",
        "skills",
        "availability"
    ];
}
