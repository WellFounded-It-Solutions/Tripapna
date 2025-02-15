<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;

    protected $table = 'modules';

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }
}
