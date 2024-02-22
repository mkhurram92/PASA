<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['amount', 'gl_code_id', 'description', 'date'];

    public function glCode()
    {
        return $this->belongsTo(GlCode::class);
    }
}
