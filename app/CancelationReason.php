<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelationReason extends Model
{
    use UsesTenantConnection, SoftDeletes;
    
    protected $guarded = [];
}
