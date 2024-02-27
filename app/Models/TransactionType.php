<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $table = 'transaction_types';
    protected $fillable = ['id', 'name'];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'transaction_type_id');
    }
}
