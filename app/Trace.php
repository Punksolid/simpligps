<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    protected $fillable = [
      "content"
    ];

    protected $casts = [
        "content" => "array"
    ];
}
