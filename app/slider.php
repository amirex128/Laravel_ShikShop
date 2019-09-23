<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
	protected $guarded=[];
    protected $casts=[
    'selected'=>'array'
    ];
	
	public static function findOrCreate($id)
	{
		$obj = static::find($id);
		return $obj ?: new static;
	}
}
