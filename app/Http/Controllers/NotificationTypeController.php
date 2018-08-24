<?php

namespace App\Http\Controllers;

use App\Notifications\DynamicNotification;
use App\NotificationType;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notification_type = NotificationType::create($request->all());

        return \response([
            "data" => [
                "alias" => $notification_type->alias,
                "deactivation_mode" => $notification_type->deactivation_mode
        ]]);
    }



    /**
     * Actualizar Tipo de Notificacion
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotificationType  $notificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationType $notificationType)
    {
        $notificationType->update($request->all());

        return response($notificationType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificationType  $notificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationType $notificationType)
    {
        //
    }

    public function activate(NotificationType $notification_type)
    {

        \Notification::send(User::all(), new DynamicNotification($notification_type));

        return \response($notification_type);
    }
}
