<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackageDetails extends Model
{
    use HasFactory;
    protected $table = 'order_package_details';

    protected $guarded = [];

    public function packages()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function getpackageLogAttribute()
    {
        return json_decode($this->attributes['package_log']);
    }
    public function gethotelLogAttribute()
    {
        return json_decode($this->attributes['hotel_log']);
    }
}
