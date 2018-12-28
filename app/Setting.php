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

}
