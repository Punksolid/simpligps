<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use UsesTenantConnection;

    protected $table = 'settings';

    protected $fillable = [
        'bulk'
    ];

    protected $cast = [
        'bulk' => 'array'
    ];

    public function getWialonToken(): string
    {

        $wialon_row_data = $this->where('key', 'wialon_key')->first();
        return $wialon_row_data->value;

    }



}
