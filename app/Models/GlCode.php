<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCode extends Model
{
    protected $fillable = ['code', 'name', 'parent_id'];

    public function parentCode()
    {
        return $this->belongsTo(GlCode::class, 'parent_id');
    }

}
