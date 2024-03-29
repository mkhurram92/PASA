<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCodesParent extends Model
{
    protected $table = 'gl_codes_parent';
    protected $fillable = ['id', 'name','description'];

    public function glCodes()
    {
        return $this->hasMany(GlCode::class, 'parent_id');
    }
}
