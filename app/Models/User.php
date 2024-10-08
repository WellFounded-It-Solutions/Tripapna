<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait; //Import The Trait
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'status',
        'role',
        'owner_id',
        'maneger_id',
        'pay_status',
        'address',
        'parent_id',
        'age',
        'hotel_id',
        'package_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'hotel_id' => 'array',
    ];
   
    public function getRoleNameAttribute()
{
    return $this->roles->first()->name;
}
public function AssignHotels()
{
    return $this->hasMany(Hotel::class, 'hotel_id');
}
public function hotels()
    {
        return Hotel::whereIn('id', $this->hotel_id)->get();
    }
}
