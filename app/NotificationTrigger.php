<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class NotificationTrigger extends Model
{
    use UsesTenantConnection;


    protected $fillable = [
        "name",
        "level",
        'control_type_obj',
        "active",
    ];

    protected $casts = [
        "active" => "bool"
    ];
}
