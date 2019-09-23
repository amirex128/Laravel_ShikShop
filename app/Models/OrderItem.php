<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [ 'variation_id' , 'count', 'price', 'offer' ];

    /**
     * Relation to ProductVariation Model
     *
     * @return ProductVariation Model
     */
    public function variation ()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
