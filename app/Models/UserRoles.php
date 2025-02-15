<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'users_roles';

    protected $guarded = [];

    public $timestamps = false;
}
