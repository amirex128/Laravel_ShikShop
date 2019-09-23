<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [ 'size', 'group' ];

    public function size_group ()
    {
        return $this->belongsTo(Size::class, 'group');
    }
}
