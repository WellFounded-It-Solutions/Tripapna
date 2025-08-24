<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'Transaction';
    protected $fillable = [
        'razorpay_order_id',
        'razorpay_payment_id',
        'amount',
        'currency',
        'status',
        'user_id',
    ];
}