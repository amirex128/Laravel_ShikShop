<?php

namespace App\Models;

use App\Robot;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

protected $guarded=[];

    protected $casts = [
        'gallery' => 'array'
    ];

    public static function productCard ($query = null, $options = [])
    {
        $result = Static::select([
            'id', 'name', 'price', 'offer', 'photo', 'gallery', 'brand_id',
            'size_id', 'design_id', 'special', 'status'
        ]);

        if ($query)
            $result->where('name', 'like', '%'.$query.'%');

        return $result->latest()->paginate(20);
    }

    public static function productInfo ($product)
    {
        return $product->load([
            'categories:categories.id,title',
//            'color:id,name,value',
            'brand:id,title',
            'size:id,size',
            'design:id,title',
            'specs:id,product_id,key,value'
        ]);
    }

    public function categories ()
    {
        return $this->belongsToMany(Category::class);
    }
	public function specification ()
	{
		return $this->hasMany(Specification::class,'product_id','id');
	}
    public function specs ()
    {
        return $this->hasMany(Specification::class);
    }

    public function brand ()
    {
        return $this->belongsTo(Brand::class);
    }

    public function color ()
    {
        return $this->belongsToMany(Color::class);
    }

    public function size ()
    {
        return $this->belongsTo(Size::class);
    }

    public function design ()
    {
        return $this->belongsTo(Design::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function robots()
    {
        return $this->belongsToMany(Robot::class);
    }
}
