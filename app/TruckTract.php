<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class TruckTract extends Model
{
    use UsesTenantConnection;

    protected $fillable = [
        'plate',
        'model',
        'internal_number',
        'brand',
        'gps',
        'color'
    ];
}
