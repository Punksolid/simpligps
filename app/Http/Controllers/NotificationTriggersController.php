<?php

namespace App\Http\Controllers;

use App\Account;
use App\Device;
use App\Events\NotificationTriggerCreated;
use App\Events\NotificationTriggerDeleted;
use App\Http\Requests\NotificationTriggerRequest;
use App\Http\Resources\NotificationTriggerResource;
use App\Log;
use App\Notifications\DynamicNotification;
use App\Notifications\WialonWebhookNotification;
use App\NotificationTrigger;
use App\Trip;
use App\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Punksolid\Wialon\Geofence;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Wialon;
/**
*   Este controlador se encarga de los Notification Triggers
* En el se listan las notificaciones que se replican en wialon
*
*
*/
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

        event(new NotificationTriggerCreated($notification_type, $request->control_type, $request->params));

        return NotificationTriggerResource::make($notification_type);

    }


//    /**
//     * Actualizar Tipo de Notificacion
//     *
//     * @param \Illuminate\Http\Request $request
//     * @param \App\NotificationTrigger $notificationType
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, NotificationTrigger $notificationType)
//    {
//        $notificationType->update($request->all());
//
//        return response($notificationType);
//    }

    /**
     * Remove the specified NotificationTrigger from storage.
     *
     * @param \App\NotificationTrigger $notificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification_trigger_id)
    {
        $notification_trigger = NotificationTrigger::findOrFail($notification_trigger_id);

        event(new NotificationTriggerDeleted($notification_trigger));

        if ( $notification_trigger->delete()){
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

    /**
     * Aqui se cachan las notificaciones convencionales
     */
    public function webhookAlert(Request $request)
    {
        $account = Account::whereUuid($request->get("X-Tenant-Id"))->firstOrFail();

        $notification_trigger = $account->getTenantData(NotificationTrigger::class)->findOrFail($request->notification_id);

        if($notification_trigger->active){
            info($account->toArray());
            \Notification::send($account, new WialonWebhookNotification("Check unit {$request->get('unit')}", $request->all()));
            $devices = $notification_trigger->devices;
            foreach($devices as $device) {
                $device->logs()->create([
                    "level" => $notification_trigger->level,
                    "data" => $request->all()
                    ]);
            }
        }
        
        return response()->json('ok');

    }
/*
* Aqui se reciben los webhooks de los trips, está separado de los de las notificaciones sencillas
*
*
**/
    public function tripAlert(Request $request, $tenant_uuid, $trip_id)
    {
        $account = Account::whereUuid($tenant_uuid)->firstOrFail();
        \Notification::send($account, new WialonWebhookNotification("Check unit {$request->get('unit')}", $request->all()));

        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);
        $trip = Trip::findOrFail($trip_id);

        $device = $trip->truck->device;
        \Log::info("trip", $trip->toArray());
        \Log::info("device", $device->toArray());
        $trip->logs()->create(['data' => $request->all()]);
        $device->logs()->create(['data' => $request->all()]);

//        $device->notify(new WialonWebhookNotification("Check unit {$request->get('unit')}", $request->all()));
//        \Notification::send($devices, );

        return response()->json('ok');
    }

    public function destroyWialonNotification($notification_id)
    {
        $notification_trigger = NotificationTrigger::findOrFail($notification_id);

        $notification_trigger->destroy();

        return \response()->json(['data' => "ok"]);
    }
}
