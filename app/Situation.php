<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Situation extends Model
{
    use UsesTenantConnection;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
}
