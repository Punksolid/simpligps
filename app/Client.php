<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use UsesTenantConnection, SoftDeletes;

    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'address',
        'contact'
    ];
}
