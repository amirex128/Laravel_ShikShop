<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [ 'message' ];

    public function user ()
    {
        return $this->belongsTo(\App\User::class);
    }
}
