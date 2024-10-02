<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCodesParent extends Model
{
    protected $table = 'gl_codes_parent';
    protected $fillable = ['id', 'name', 'description', 'account_type_id', 'is_bank_account'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'parent_id');
    }
    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }
    public function accountBalances()
    {
        return $this->hasMany(AccountBalance::class, 'gl_codes_parent_id');
    }
}
