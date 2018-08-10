<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Trip extends Model
{
    use HasTags;

    protected $fillable = [
            "rp",
            "invoice",
            "client",
            "intermediary",
            "origin",
            "destination",
            "mon_type",
            "line",
            "scheduled_load",
            "scheduled_departure",
            "scheduled_arrival",
            "scheduled_unload",
            "bulk",
        //tag
            "tag"
        ];

    protected $casts = [
        "bulk" => "array"
    ];


};
