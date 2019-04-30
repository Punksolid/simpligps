<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use UsesTenantConnection, SoftDeletes;

    protected $fillable = [
        'description',
        'company_name',
        'address',
        'city',
        'state',
        'phone',
        'email',
        'person_name',
        'status',
        'email_frequency'
    ];
}
