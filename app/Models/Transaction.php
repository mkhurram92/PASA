<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['amount', 'transaction_type_id', 'account_id', 'gl_code_id', 'description'];

    public function glCode()
    {
        return $this->belongsTo(GlCode::class, 'gl_code_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
    
}
