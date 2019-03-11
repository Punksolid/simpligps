<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Http\Resources\InternalNotificationResource;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;

/**
 * Class MeController
 * @package App\Http\Controllers
 * @resource Me
 */
class MeController extends Controller
{
    /**
     * Logged user information
     *
     * @return UsersResource
     */
    public function meInfo()
    {
        $user = auth()->user();

        return UsersResource::make($user);
    }

    /**
     * Devuelve las notificaciones internas del sistema del usuario, las estandar de Laravel
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getNotifications()
    {
        $notifications = auth()->user()->notifications;
        return InternalNotificationResource::collection($notifications);
    }

    /**
     * Cambia la contraseña del usuario loggeado, solo es necesario password y pasword_confirmation
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            "password" => "required|confirmed"
        ]);
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        return response()->json($user->save());

    }

    /*
     * @respons
     */
    public function permissions()
    {
        return response()->json([
                "data" => auth()->user()->getAllPermissions()
            ]
        );
    }

    /**
     * Devuelve todas las cuentas de un usuario, necesario para el login y la especificacion del tenant
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function accounts()
    {
        return AccountResource::collection(auth()->user()->accounts);
    }
}
