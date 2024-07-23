<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use AuditableTrait,Searchable;

    protected $guarded = [];

    protected $table = 'customers';

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ];
    }
}
