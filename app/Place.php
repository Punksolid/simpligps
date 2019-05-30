<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use UsesTenantConnection, SoftDeletes;

    protected $table = "places";

    protected $fillable = [
        "name",
        "person_in_charge",
        "address",
        "phone",
        "geofence_ref",
        "high_risk"
    ];

    protected $cast = [
        "high_risk" => 'bool'
    ];
}
