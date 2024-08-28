<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SaleExecutive extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'sales_executive';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'address',
        'mobile',
        'age',
        'package_id',
        'id_proof',
        'manager_id'
    ];


}
