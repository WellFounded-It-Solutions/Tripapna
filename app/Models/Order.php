<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory,Searchable;
    protected $table = 'tbl_orders';
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
