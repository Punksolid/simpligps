<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasPermissions;

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
        $auth = \Auth::guard('sysadmin');
        $token = $auth->attempt($credentials);
        if (!$token) {
            abort(401, 'Usuario o contraseña son incorrectos.');
        }

        \Auth::guard('sysadmin')->user(); // @Todo tal vez no es más necesario
        $token = $auth->user()->createToken('sysadmin-api')->accessToken;

        return response([
            'data' => [
                'access_token' => $token,
                'code' => 20000,
            ],
        ], 200);
    }
}
