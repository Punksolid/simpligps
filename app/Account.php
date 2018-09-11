<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        "easy_name",
        "uuid"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,"users_accounts");
    }
}
