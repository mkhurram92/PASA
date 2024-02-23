<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCode extends Model
{
    protected $table = 'gl_codes';
    protected $fillable = ['code', 'name', 'description', 'parent_id'];

    public function glCodesParent()
    {
        //return $this->belongsTo(GlCodesParent::class, 'parent_id');
        return $this->belongsTo(GlCodesParent::class, 'parent_id', 'id');
    }
}
