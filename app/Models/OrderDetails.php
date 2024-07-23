<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';
     protected $guarded = [];

     public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function getcouponDataAttribute()
    {
        return json_decode($this->attributes['coupon_data']);
    }
    public function gethotelDataAttribute()
    {
        return json_decode($this->attributes['hotel_data']);
    }
}
