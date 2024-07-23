<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelCoupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'hotelcoupons';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function getimageAttribute()
    {
        if ($this->attributes['image']) {
            return env('ADMIN_PATH') . 'coupon/' . $this->attributes['image'];
        } else {
            return env('ADMIN_PATH') . 'no_image.jpg';
        }
    }
}
