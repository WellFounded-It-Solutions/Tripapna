<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelImages extends Model
{
    use HasFactory;
    protected $table = 'hotelimages';
    protected $guarded = [];

    public function getimagesAttribute()
    {
        if ($this->attributes['images']) {
            return env('ADMIN_PATH') . 'hotelimages/' . $this->attributes['images'];
        } else {
            return env('ADMIN_PATH') . 'no_image.jpg';
        }
    }
}
