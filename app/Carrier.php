<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use UsesTenantConnection;

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
