<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersContact extends Model
{
    protected $table = 'members_contacts';

    protected $fillable = [
        'member_id',
        'email',
        'mobile',
        'phone',
        'area_code',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}