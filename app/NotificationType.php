<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
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
