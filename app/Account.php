<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        "easyname",
        "uuid",
        "bulk"
    ];

    protected $casts = [
        "bulk" => "array"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,"users_accounts");
    }
}
