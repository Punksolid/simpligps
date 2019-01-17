<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use App\Sysadmin;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
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
        $auth = \Auth::guard("sysadmin");

        if (!$token = $auth->attempt($credentials)) {
            abort(401, "Usuario o contraseña son incorrectos.");
        }

        $user = \Auth::guard("sysadmin")->user();
        $token = $auth->user()->createToken('sysadmin-api')->accessToken;
        return response([
            "data" => [
                "access_token" => $token,
                "code" => 20000
            ]
        ], 200);
    }

}
