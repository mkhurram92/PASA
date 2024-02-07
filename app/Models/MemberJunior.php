<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberJunior extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    function withGender(){
        return $this->belongsTo(Gender::class,"gender");
    }

    function withSubscription(){
        return $this->hasOne(Subscription::class, "user_id","id");
    }
}
