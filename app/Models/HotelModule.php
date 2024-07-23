<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelModule extends Model
{
    use HasFactory;

    protected $table = 'hotel_modules';

    public function permissions()
    {
        return $this->hasMany(HotelModulePermission::class, 'module_id');
    }
}
