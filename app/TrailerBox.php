<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerBox extends Model
{
    use UsesTenantConnection,SoftDeletes;

    protected $fillable = [
      'internal_number',
      'gps',
      'plate',
    ];
}
