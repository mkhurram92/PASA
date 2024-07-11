<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'guard_name',
    ];

    // Define the relationship with users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
