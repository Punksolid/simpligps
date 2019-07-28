<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Punksolid\Wialon\Geofence;

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

    #region Actions
    public function verifyConnection():bool
    {
        if ($this->geofence_ref){
            [$resource, $id] = explode("_",$this->geofence_ref);
            return (bool)Geofence::findById($id,$resource);

        }

        return false;

    }
    #endregion

}
