<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'transaction_date'];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
