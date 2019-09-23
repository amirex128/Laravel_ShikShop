<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\Spec;

class Category extends Model
{
    protected $fillable = [ 'parent', 'title', 'description', 'icon', 'banner' ];
    
    public function parent_group ()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function products () 
    {
        return $this->belongsToMany(Product::class);
    }

    public function childs ()
    {
        return $this->hasMany(Category::class, 'parent');
    }
}
