<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotelrole extends Model
{
    use HasFactory;
    protected $table = 'hotel_roles';
    // public function permissions()
    // {
    //     return $this->belongsToMany(HotelRolePermission::class, 'roles_permissions');
    // }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'users_roles');
    // }
}
