<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "payment_method",
        "start_date",
        "end_date",
        "user_id",
        "is_blocked",
        "reason",
        "stripe_payment_id",
        "member_type",
        "payment_intent_id",
        "amount",
        "status",
        "stripe_response",
        "meta_description",
        "created_by",
        "updated_by",
        "deleted_by",
    ];

    protected $casts = [
        "meta_description" => "array"
    ];
}
