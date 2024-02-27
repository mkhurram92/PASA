<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCode extends Model
{
    protected $table = 'gl_codes';
    protected $fillable = ['name', 'description', 'parent_id'];

    public function glCodesParent()
    {
        return $this->belongsTo(GlCodesParent::class, 'parent_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'gl_code_id', 'id');
    }
}
