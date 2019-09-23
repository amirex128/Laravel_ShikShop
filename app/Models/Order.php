<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Morilog\Jalali\Jalalian;
use DB;

class Order extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'buyer', 'discount_code_id', 'admin_description', 'buyer_description', 'destination',
        'postal_code', 'offer', 'shipping_cost', 'total', 'status', 'payment',
        'payment_jalali', 'auth_code', 'payment_code', 'datetimes'
    ];

    /**
     * Relation to user Model
     *
     * @return User Model
     */
    public function user ()
    {
        return $this->belongsTo(\App\User::class, 'buyer');
    }

    /**
     * Relation to OrderItem Model
     *
     * @return OrderItem Model
     */
    public function items ()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function discount_code ()
    {
        return $this->belongsTo(DiscountCode::class);
    }

    /**
     * return list of orders
     *
     * @return Collection
     */
    public static function list ()
    {
        return Static::select('id', 'buyer', 'status', 'created_at', 'payment', 'total', 'offer', 'shipping_cost')
            ->with('user:id,first_name,last_name,email')->latest()->paginate(20);
    }
    
    /**
     * return total of orders price according to period of time
     *
     * @param String $period
     * @return Collection
     */
    public static function total ( $period )
    {
        /**
         * Highlighting type of requested period
         * @param String $period
         */
        switch ( $period )
        {
            case 'daily':   $period = 'day';   $before = '1 month'; break;
            case 'weekly':  $period = 'week';  $before = '3 month'; break;
            case 'monthly': $period = 'month'; $before = '1 year';  break;
            case 'yearly':  $period = 'year';  $before = '10 year'; break;
        }

        return Static::select([
            DB::raw("$period(payment_jalali) as 'period'"),
            DB::raw("SUM(total - offer) 'sum'")
        ])
        ->groupBy('period')
        ->where( 'payment_jalali', '>', Jalalian::forge("now - $before") )
        ->whereNotNull('payment_jalali')->get();
    }

    /**
     * return total of income
     *
     * @return Integer
     */
    public static function total_income ()
    {
        return static::select([ DB::raw("SUM(total - offer) AS 'sum'") ])
            ->whereNotNull('payment_jalali')->get()[0]->sum;
    }

    /**
     * return compare the count of orders from prevoius month
     *
     * @return Int
     */
    public static function compare ()
    {
        $month = Jalalian::forge("now")->getMonth();
        $result = Static::select([
                DB::raw("MONTH(payment_jalali) as 'period'"),
                DB::raw("COUNT(id) 'count'")
            ])
            ->groupBy('period')
            ->whereIn( DB::raw("MONTH(payment_jalali)"), [$month, $month - 1])
            ->where( 'payment_jalali', '>', Jalalian::forge("now - 2 month") )
            ->whereNotNull('payment_jalali')->get();

        return ($result == []) 
            ? round( ( $result[1]->count - $result[0]->count ) * 100 / $result[1]->count )
            : 0; 
    }

    /**
     * return full informatino of specific orders
     *
     * @return Object
     */
    public static function full_info ($order)
    {
        $order->user = $order->user()->get()[0];
        $order->items = $order->items()->with([
            'variation',
            'variation.warranty:id,title,expire',
            'variation.color:id,name,value',
            'variation.product:id,name,code,photo'
        ])->get();

        return $order;
    }

    /**
     * Fianl_Total Mutators
     *
     * @return String final_total
     */
    public function getFinalTotalAttribute()
    {
        return ( $this->shipping_cost + $this->total ) - $this->offer;
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
