<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coupons()
    {
        return $this->belongsTo(HotelCoupon::class, 'coupon_id');
    }
    public function Package()
    {
        return $this->belongsTo(Package::class, 'coupon_id');
    }
}
