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
    ];
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
