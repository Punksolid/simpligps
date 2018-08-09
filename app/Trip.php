<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
//            "rp",
//            "invoice",
//            "client",
//            "intermediary",
//            "origin",
//            "destination",
//            "mon_type",
//            "line",
//
//            "scheduled_load",
//            "scheduled_departure",
//            "scheduled_arrival",
//            "scheduled_unload",
            "bulk"
        ];

    protected $casts = [
        "bulk" => "array"
    ];
};
