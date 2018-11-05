<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Sysadmin extends Authenticatable
{

    use HasApiTokens;

    protected $guard_name = 'sysadmin';

    protected $table = "sysadmins";

    protected $fillable = [
        "email",
        "password"
    ];




}
