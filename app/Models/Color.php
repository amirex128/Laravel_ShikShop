<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [ 'name', 'value' ,'user_id'];

	public function product()
	{
		return $this->belongsToMany(Product::class);
		
    }
}
