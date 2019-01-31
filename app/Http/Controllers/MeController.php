<?php

namespace App\Http\Controllers;

use App\Http\Resources\InternalNotificationResource;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Logged user information
     *
     * @return \Illuminate\Http\Response
     */
    public function meInfo()
    {
        return UsersResource::make(auth()->user());
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

}
