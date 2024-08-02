<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAncestor extends Model
{
    protected $table = 'member_ancestor';

    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function ancestor()
    {
        return $this->belongsTo(AncestorData::class, 'ancestor_id');
    }
    public function Gender()
    {
        return $this->belongsTo(Gender::class, "gender");
    }

}
