<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id', 'value', 'quality', 'design', 'total', 'review'
    ];
    
    /**
     * relation to product model
     *
     * @return Product Model
     */
    public function product ()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * relation to user model
     *
     * @return User Model
     */
    public function user ()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * return list of reviews
     *
     * @return Collection
     */
    public static function list ()
    {
        return Static::select('user_id', 'product_id', 'total', 'review', 'created_at')
            ->with([
                'product:id,name',
                'user:id,first_name,last_name'
            ])->latest()->paginate(10);
    }

    /**
     * Full_name Mutators
     *
     * @return String
     */
    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->last_name;
    }
}