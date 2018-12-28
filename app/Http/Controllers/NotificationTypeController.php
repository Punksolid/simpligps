<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationTypeRequest;
use App\Notifications\DynamicNotification;
use App\NotificationType;
use App\User;
use Faker\Factory;
use http\Env\Response;
use Illuminate\Http\Request;
use Punksolid\Wialon\Geofence;
use Punksolid\Wialon\Wialon;

class NotificationTypeController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationTypeRequest $request)
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
     * @param  \Illuminate\Http\Request $request
     * @param  \App\NotificationType $notificationType
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
     * @param  \App\NotificationType $notificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationType $notificationType)
    {
        //
    }


    /**
     * Envía a todos los usuarios el mensaje de notification
     * @param NotificationType $notification_type
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function activate(NotificationType $notification_type)
    {
        \Notification::send(User::all(), new DynamicNotification($notification_type));

        return \response($notification_type);
    }

    /**
     * Recibe Resource_ID, Nombre, Latitud, Longitud y  radio
     */
    public function createGeofence(Request $request)
    {
        return \response()->json($request->all());
        $name = $request->geofence_name;

        $lat = $request->lat;
        $lon = $request->lon;
        $radius = $request->radius;

        $faker = Factory::create();

        $wialon_api = new Wialon();
        $resource = $wialon_api->createResource("asdewd1".$faker->word . $faker->unique()->word.$faker->unique()->word);
        //TODO resource puede ser creado si no es especificado o usar uno preexistente

        $geofence = Geofence::make(
            $resource->id,
            $name,
            $lat,
            $lon,
            $radius,
            3);

        return \response()->json($geofence->toArray());
    }
}
