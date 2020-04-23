<?php

namespace App;

//use Hyn\Tenancy\Traits\UsesSystemConnection;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sysadmin extends Authenticatable
{
    use HasApiTokens;
//    use UsesSystemConnection;

    protected $guard_name = 'sysadmin';

    protected $table = 'sysadmins';

    protected $fillable = [
        'email',
        'password',
    ];
}
