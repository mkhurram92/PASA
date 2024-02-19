<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersAddress extends Model
{
    protected $table = 'members_addresses';
    
    protected $fillable = [
        'unit_no',
        'number_street',
        'suburb',
        'post_code',
        'state_id',
        'country_id'
    ];
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function state()
    {
        return $this->belongsTo(States::class, 'state_id');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}
