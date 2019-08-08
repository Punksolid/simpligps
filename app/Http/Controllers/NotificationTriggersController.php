<?php

namespace App\Http\Controllers;

use App\Device;
use App\Events\NotificationTriggerCreated;
use App\Events\NotificationTriggerDeleted;
use App\Http\Requests\NotificationTriggerRequest;
use App\Http\Resources\NotificationTriggerResource;
use App\NotificationTrigger;

/**
 *   Este controlador se encarga de los Notification Triggers
 * En el se listan las notificaciones que se replican en wialon.
 */
class NotificationTriggersController extends Controller
{
    public function index()
    {
        $notification_triggers = NotificationTrigger::with('devices')->paginate();

        return NotificationTriggerResource::collection($notification_triggers);
    }

    /**
     * Store a newly created NotificationTrigger in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
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

    /**
     * Remove the specified NotificationTrigger from storage.
     *
     * @param \App\NotificationTrigger $notificationType
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification_trigger_id)
    {
        $notification_trigger = NotificationTrigger::findOrFail($notification_trigger_id);

        event(new NotificationTriggerDeleted($notification_trigger));

        if ($notification_trigger->delete()) {
            return response()->json([
                'message' => 'Success',
            ]);
        }

        return response()->json([
            'message' => 'Error deleting notification',
        ]);
    }

    public function destroyWialonNotification($notification_id)
    {
        $notification_trigger = NotificationTrigger::findOrFail($notification_id);

        $notification_trigger->destroy();

        return \response()->json(['data' => 'ok']);
    }
}
