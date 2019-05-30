<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    use UsesTenantConnection;

    protected $fillable = [
      'content',
    ];

    protected $casts = [
      'content' => 'array',
    ];
}
