<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $table = 'subscription_plan';

    protected $fillable = [
        "name",
        "description",
        "email_price",
        "post_price",
        "joining_fee",
        "created_by",
        "updated_by",
        "deleted_by"
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'member_type_id');
    }
}
