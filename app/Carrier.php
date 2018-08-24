<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
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
