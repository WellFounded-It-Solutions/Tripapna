<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRolePermission extends Model
{
    use HasFactory;

    protected $table = 'hotel_roles_permissions';

    protected $guarded = [];

    public $timestamps = false;
}
