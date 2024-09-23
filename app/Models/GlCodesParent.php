<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCodesParent extends Model
{
    protected $table = 'gl_codes_parent';
    protected $fillable = ['id', 'name','description'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'parent_id');
    }
}
