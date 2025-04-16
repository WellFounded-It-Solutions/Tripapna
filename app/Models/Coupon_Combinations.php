<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon_Combinations extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'coupon_id',
        'package_id',
        'cannot_combine_id',
    ];

    protected $table = 'coupon_combinations';

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function cannotCombine()
    {
        return $this->belongsTo(Coupon::class, 'cannot_combine_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
