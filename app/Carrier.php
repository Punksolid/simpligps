<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrier extends Model
{
    use UsesTenantConnection,SoftDeletes;

    protected $fillable = [
      "carrier_name",
      "contact_name",
      "phone",
      "email"
    ];

    public function operators()
    {
        return $this->hasMany(Operator::class);
    }
}
