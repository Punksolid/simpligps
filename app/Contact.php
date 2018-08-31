<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        "name",
        "company",
        "phone",
        "email",
        "address",
        "localization"
    ];

    protected $casts = [
        "bulk" => "array"
    ];
}
