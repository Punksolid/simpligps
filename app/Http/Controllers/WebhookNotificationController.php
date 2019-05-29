<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Notifications\WialonWebhookNotification;
use App\Trip;
use App\Http\Requests\DeviceNotificationRequest;
use App\Account;

class WebhookNotificationController extends Controller
{
    /**
     * Aqui se cachan las notificaciones convencionales.
     */
    public function simpleAlert(DeviceNotificationRequest $request)
    {
        $account = Account::whereUuid($request->get('X-Tenant-Id'))->firstOrFail();

        $notification_trigger = $account->getTenantData(NotificationTrigger::class)->findOrFail($request->notification_id);

        if ($notification_trigger->active) {
            // $devices = $notification_trigger->devices; // antes enviaba al log de todos los devices de la notificacion @deprecado
            $device = Device::where('wialon_id', $request->unit_id)->first();
            \Notification::send($account, new WialonWebhookNotification("$notification_trigger->name.Check {$request->get('unit')}", $request->all(), $device));
            if ($device) {
                $device->log($notification_trigger->level, $notification_trigger->name, $request->all());
            }
        }

        return response()->json('ok');
    }

    /*
    * Aqui se reciben los webhooks de los trips, está separado de los de las notificaciones sencillas
    *
    **/
    public function tripAlert(Request $request, $tenant_uuid, $trip_id)
    {
        $account = Account::whereUuid($tenant_uuid)->firstOrFail();

        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);
        $trip = Trip::findOrFail($trip_id);

        $device = $trip->truck->device;
        $trip->info('Update on Trip', $request->all());
        $device->info('Update on Device', $request->all());
        \Notification::send($account, new WialonWebhookNotification(
            "Check TRIP {$request->get('unit')}",
            $request->all(),
            $device
        ));

        return response()->json('ok');
    }
}