<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        "name",
        "person_in_charge",
        "address",
        "phone",
    ];
}
