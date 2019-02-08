<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primary_key = 'email';


    protected $fillable = [
        'email', 'token'
    ];

    public $timestamps = [
        "created_at"
    ];

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
}
