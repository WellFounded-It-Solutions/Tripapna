<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesBoyOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'offer', 'commission', 'automatic_credit_commission', 'description', 'status'
    ];
}
