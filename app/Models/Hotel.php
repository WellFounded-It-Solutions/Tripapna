<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hotel extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected $guard = 'hotel';

    protected $table = 'hotels';
    // protected $hidden = array('password');

    public function getlogoAttribute()
    {
        if ($this->attributes['logo']) {
            return env('ADMIN_PATH') . 'logo/' . $this->attributes['logo'];
        } else {
            return env('ADMIN_PATH') . 'no_image.jpg';
        }
    }
    public function images()
    {
        return $this->hasMany(hotelImages::class, 'hotel_id');
    }
}
