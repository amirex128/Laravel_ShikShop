<?php

namespace App;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $guarded=[];

	public function category()
	{
		return $this->belongsTo(Category::class);
    }
}
