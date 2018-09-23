<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\Sysadmin;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasPermissions;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminLoginController extends Controller
{

    use HasPermissions;

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        \Auth::guard("sysadmin")->attempt($credentials);
        $user = \Auth::guard("sysadmin")->user();
        $token =  $user->createToken('sysadmin')->accessToken;

        return response([
            "data" => [
                "access_token" => $token
            ]
        ]);
    }

}
