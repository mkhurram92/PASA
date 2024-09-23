<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlCode extends Model
{
    protected $table = 'gl_codes';
    protected $fillable = ['name', 'description', 'parent_id'];

}
