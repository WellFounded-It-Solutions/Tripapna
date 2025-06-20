<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayPackages extends Model
{
    use HasFactory;
   protected $table = 'holiday_packages';
   protected $fillable = [
        'title',
        'limit',
        'term_conditions',
        'description',
        'amount',
        'discount',
        'image',
        'owner_id',
        'valid_date',
        'variable_month',
        'expire_type',
    ];

}
