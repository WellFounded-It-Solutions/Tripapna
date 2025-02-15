<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Categories extends Model implements Auditable
{
    use AuditableTrait;

    protected $guarded = [];

    protected $table = 'categories';

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'category_id');
    }
}
