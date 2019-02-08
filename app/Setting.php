<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
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
