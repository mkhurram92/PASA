<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalMemberInfos extends Model
{
    use HasFactory;
    protected $table = 'additional_member_info';
    protected $fillable = [
        "member_id",
        "membership_number",
        "general_notes",
        "end_status_notes",
        "partner_member",
        "volunteer",
        "volunteer_skills_working",
        "registration_form_received",
        "signed_agreement",
        "key_holder",
        "key_held",
        "date_membership_end",
        "date_membership_approved"
    ];
}
