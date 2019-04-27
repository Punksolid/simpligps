<?php

namespace App\Http\Controllers;

use App\Account;
use App\Device;
use App\Http\Requests\NotificationTriggerRequest;
use App\Http\Resources\NotificationTriggerResource;
use App\Notifications\DynamicNotification;
use App\Notifications\WialonWebhookNotification;
use App\NotificationTrigger;
use App\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Punksolid\Wialon\Geofence;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Wialon;

class NotificationTriggersController extends Controller
{

    public function index()
    {
        return NotificationTriggerResource::collection(NotificationTrigger::paginate());
    }

    /**
     * Store a newly created NotificationTrigger in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationTriggerRequest $request)
    {

        $notification_type = NotificationTrigger::create($request->all()); // internal
        foreach ($request->devices_ids as $device_id) {
            $device = Device::findOrFail($device_id);
            $notification_type->addDevice($device);
        }
        $notification_type->createExternalNotification($request->control_type, $request->params); // wialon

        return NotificationTriggerResource::make($notification_type);

    }


    /**
     * Actualizar Tipo de Notificacion
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\NotificationTrigger $notificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationTrigger $notificationType)
    {
        $notificationType->update($request->all());

        return response($notificationType);
    }

    /**
     * Remove the specified NotificationTrigger from storage.
     *
     * @param \App\NotificationTrigger $notificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification_trigger_id)
    {
        $notification_trigger = NotificationTrigger::findOrFail($notification_trigger_id);

        $wialon_notification = Notification::findByUniqueId($notification_trigger->wialon_id);
        $wialon_notification->resource = new Resource(["id" => explode("_",$notification_trigger->wialon_id)[0]]);


        if ($wialon_notification->destroy() && $notification_trigger->delete()){
            return response()->json([
                "message" => "Success"
            ]);
        }

        return response()->json([
            "message" => "Error deleting notification"
        ]);
    }


    /**
     * Envía a todos los usuarios el mensaje de notification
     * @param NotificationTrigger $notification_type
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function activate(NotificationTrigger $notification_type)
    {
        \Notification::send(User::all(), new DynamicNotification($notification_type));

        return \response($notification_type);
    }

    /**
     * Recibe Resource_ID, Nombre, Latitud, Longitud y  radio
     */
    public function createGeofence(Request $request)
    {
        //return \response()->json($request->all());
        $name = $request->geofence_name;

        $lat = $request->lat;
        $lon = $request->lon;
        $radius = $request->radius;

        $faker = Factory::create();

        $wialon_api = new Wialon();
        $resource = $wialon_api->createResource("asdewd1" . $faker->word . $faker->unique()->word . $faker->unique()->word);
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

    public function getGeofences()
    {

    }

    public function webhookAlert(Request $request)
    {
        $account = Account::whereUuid($request->get("X-Tenant-Id"))->firstOrFail();
        info($account->toArray());
        \Notification::send($account, new WialonWebhookNotification("Check unit {$request->get('unit')}", $request->all()));

        return response()->json('ok');


    }

    public function destroyWialonNotification($notification_id)
    {
        $notification = Notification::find($notification_id);

        $notification->destroy();

        return \response()->json(['data' => "ok"]);
    }
}
