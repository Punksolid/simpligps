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
use Illuminate\Support\Str;
use App\Http\Requests\DeviceNotificationRequest;

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
        $request_arr = $request->toArray();

     
        $notification_type = NotificationTrigger::create($request_arr); // internal
        foreach ($request->devices_ids as $device_id) {
            $device = Device::findOrFail($device_id);
            $notification_type->addDevice($device);
        }

        event(new NotificationTriggerCreated($notification_type, $request->control_type, $request_arr['params']));

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

        if ($notification_trigger->delete()) {
            return response()->json([
                "message" => "Success"
            ]);
        }

        return response()->json([
            "message" => "Error deleting notification"
        ]);
    }

    public function getGeofences()
    { }

    /**
     * Aqui se cachan las notificaciones convencionales
     */
    public function webhookAlert(DeviceNotificationRequest $request)
    {

        $account = Account::whereUuid($request->get("X-Tenant-Id"))->firstOrFail();

        $notification_trigger = $account->getTenantData(NotificationTrigger::class)->findOrFail($request->notification_id);

        if ($notification_trigger->active) {
            
            // $devices = $notification_trigger->devices;
            $device = Device::where("wialon_id", $request->unit_id)->first();
            \Notification::send($account, new WialonWebhookNotification("$notification_trigger->name.Check {$request->get('unit')}", $request->all(), $device));
            if($device){
                $device->log($notification_trigger->level, $notification_trigger->name, $request->all());
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
        \Notification::send($account, new WialonWebhookNotification("Check TRIP {$request->get('unit')}", $request->all()));

        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);
        $trip = Trip::findOrFail($trip_id);

        $device = $trip->truck->device;
        \Log::info("trip", $trip->toArray());
        \Log::info("device", $device->toArray());
        // $trip->logs()->create(['context' => $request->all()]); // old way, deprecated
        $trip->info("Update on Trip", $request->all());
        $device->info("Update on Device", $request->all());

        // $device->logs()->create(['context' => $request->all()]);

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
