<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use UsesTenantConnection;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        "description",
        'bulk',
    ];

    protected $cast = [
        'bulk' => 'array',
    ];

    public function getWialonToken(): string
    {
        return $this->where('key', 'wialon_key')->first()->value;
    }
}
