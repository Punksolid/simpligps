<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationTriggerResource;
use App\NotificationTrigger;
use Illuminate\Http\Request;

class ActivatedNotificationTriggerController extends Controller
{
    public function destroy($id)
    {
        $notification_trigger = NotificationTrigger::findOrFail($id);
        $notification_trigger->deactivate();

        return NotificationTriggerResource::make($notification_trigger);
    }

    public function store(Request $request)
    {
        $notification_trigger = NotificationTrigger::findOrFail($request->notification_id);
        $notification_trigger->activate();

        return NotificationTriggerResource::make($notification_trigger);
    }
}
