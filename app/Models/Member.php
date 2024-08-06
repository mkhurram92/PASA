<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'approved_at' => 'datetime',
    ];

    //public function ancestor()
    //{
    ///    return $this->hasOne(MemberAncestor::class);
    //}
    public function ancestors()
    {
        return $this->belongsToMany(AncestorData::class, 'member_ancestor', 'member_id', 'ancestor_id');
    }

    public function pedigree()
    {
        return $this->hasMany(MemberPedigree::class);
    }

    public function parent_member()
    {
        return $this->hasOne(Member::class, "id", "parent_id");
    }
    public function partner_member()
    {
        return $this->hasOne(Member::class, "id", "partner_id");
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, "user_id", "id");
    }

    public function additionalInfo()
    {
        return $this->hasOne(AdditionalMemberInfos::class, "member_id", "id");
    }

    public function volunteerDetails()
    {
        return $this->hasOne(VolunteerDetail::class, "member_id", "id");
    }

    public function membershipType()
    {
        return $this->hasOne(MembershipType::class, "id", "member_type_id");
    }

    public function membershipStatus()
    {
        return $this->hasOne(MembershipStatus::class, "id", "member_status_id");
    }

    public function paymentType()
    {
        return $this->hasOne(PaymentType::class, "id", "member_type_id");
    }

    //Coded by Mirza
    public function contact()
    {
        return $this->hasOne(MembersContact::class);
    }

    public function address()
    {
        return $this->hasOne(MembersAddress::class);
    }
    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id');
    }
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'member_type_id');
    }
}
