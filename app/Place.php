<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use UsesTenantConnection;

    protected $table = "places";

    protected $fillable = [
        "name",
        "person_in_charge",
        "address",
        "phone",
    ];
}
