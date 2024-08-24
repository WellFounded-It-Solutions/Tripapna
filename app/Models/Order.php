<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory,Searchable;
    protected $table = 'tbl_orders';
    protected $fillable = [
        'order_id',    // Add 'order_id' to allow mass assignment
        'hotel_id',
        'user_id',
        'user_name',   // Add other fields as necessary
        'user_email',
        'user_phone',
        'trans_id',
        'type'
        // Add any other fields you want to be mass assignable
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
    public function orderPackageDetails()
    {
        return $this->hasMany(OrderPackageDetails::class, 'order_id');
    }

    public function packageDetails()
    {
        return $this->hasMany(OrderPackageDetails::class, 'order_id');
    }
    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'order_id' => $this->order_id,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_phone' => $this->user_phone,
            'trans_id' => $this->trans_id,
        ];
    }
}
