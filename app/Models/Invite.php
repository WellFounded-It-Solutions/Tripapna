<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invite_link'; // or your actual table name if different

    protected $fillable = [
        'cart_id',
        'status',
        'sales_id',
        'order_id',
    ];

    public $timestamps = false; // set to true if you have created_at, updated_at columns
}
