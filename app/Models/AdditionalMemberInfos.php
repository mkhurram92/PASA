<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        "month_membership_end",
        "year_membership_end",
        "date_membership_approved",
        "month_membership_approved",
        "year_membership_approved"
    ];

    /**
     * Get the full membership end date as a Carbon instance.
     *
     * @return Carbon|null
     */
    public function getMembershipEndDateAttribute()
    {
        if ($this->date_membership_end && $this->month_membership_end && $this->year_membership_end) {
            return Carbon::create(
                $this->year_membership_end,
                $this->month_membership_end,
                $this->date_membership_end
            );
        }

        return null;
        
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }


}
