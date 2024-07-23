<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function getimageAttribute()
    {
        if ($this->attributes['image']) {
            return env('ADMIN_PATH') . 'coupon/' . $this->attributes['image'];
        } else {
            return env('ADMIN_PATH') . 'no_image.jpg';
        }
    }
}
