<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = [ 'title', 'expire' ];

    /**
     * Name Mutators
     *
     * @return String final_total
     */
    public function getNameAttribute()
    {
        return $this->title.' '.$this->expire;
    }
}
