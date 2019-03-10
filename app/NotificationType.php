<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use UsesTenantConnection;


    protected $fillable = [
        "alias",
        "level",
        "active",
        "deactivation_mode"
    ];

    protected $casts = [
        "active" => "bool"
    ];
}
