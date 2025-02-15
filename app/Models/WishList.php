<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'wish_list';
    public function coupons()
    {
        return $this->belongsTo(HotelCoupon::class, 'item_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'item_id');
    }
}
