<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'packages';

    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }

    public function PackageItem()
    {
        return $this->hasMany(PackageItem::class, 'package_id');
    }
    public function getimageAttribute()
    {
        if ($this->attributes['image']) {
            return env('ADMIN_PATH').'package/'.$this->attributes['image'];
        } else {
            return env('ADMIN_PATH').'no_image.jpg';
        }
    }
}
