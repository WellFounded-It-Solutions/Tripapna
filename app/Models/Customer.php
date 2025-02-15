<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable implements Auditable
{
    use AuditableTrait,Searchable,HasApiTokens, HasFactory;

    protected $guarded = [];

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'status',
        'address',
        'pincode',
        'dob',
        'anniversary',
    ];
    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'dob' => $this->dob,
            'anniversary' => $this->anniversary
        ];
    }
}
