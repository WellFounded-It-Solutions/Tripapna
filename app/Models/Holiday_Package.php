<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday_Package extends Model
{
    use HasFactory;
    protected $table = 'holiday_package';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'destination',
        'travel_date',
        'duration',
        'travelers',
        'budget',
        'preferences',
        'passport_copy_path'
    ];
}
