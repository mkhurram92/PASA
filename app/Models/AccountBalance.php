<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'gl_codes_parent_id',
        'opening_balance',
        'closing_balance',
        'financial_year_start',
        'financial_year_end',
    ];    
}
