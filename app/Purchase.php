<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'email',
        'audit',
    ];

    protected $casts = [
        'audit' => 'array',
    ];
}
