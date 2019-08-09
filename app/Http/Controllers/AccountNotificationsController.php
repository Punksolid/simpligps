<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Http\Resources\InternalNotificationResource;
use App\Device;

class AccountNotificationsController extends Controller
{
    /**
     * Devuelve las notificaciones internas del sistema del usuario, las estandar de Laravel.
     *
     * @todo Pasar getNotifications al index, revisar si en los test se esta ejecutando
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $account = $this->getAccount();
        $notifications = $account
            ->unreadNotifications()
            ->paginate(100);

        return InternalNotificationResource::collection($notifications);
    }

    public function markAsRead($uuid)
    {
        $this->getAccount()->notifications()->where('id', $uuid)->first()->markAsRead();

        return \response()->json(['data' => 'ok']);
    }

    /**
     * Devuelve las notificaciones internas del sistema del usuario, las estandar de Laravel.
     *
     * @deprecated Pasar pasar logica de este al index por ser listado
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getNotifications(Request $request)
    {
        $notifications = $request
            ->tenant_account
            ->unreadNotifications()
            ->paginate(100);

        return InternalNotificationResource::collection($notifications);
    }

    public function getAccount(): ?Account
    {
        $account_uuid = \request()->header('X-Tenant-Id', null);

        return \request()->user()->accounts()->where('uuid', $account_uuid)->firstOrFail();
    }

    public function resolve(Request $request)
    {
        $resolution = $request->validate([
            'notifications_ids' => 'required|array',
            'solved' => 'required|bool',
            'message' => 'required|min:5',
        ]);

        $account = $this->getAccount();

        $notifications = $account->notifications()->whereIn('id', $resolution['notifications_ids'])->get();

        if ($resolution['solved']) {
            $notifications->markAsRead();
        }

        $notifications = $this->addLogToDevice($notifications, $resolution['message']);

        return InternalNotificationResource::collection($notifications);
    }

    private function addLogToDevice($notifications, $log_message)
    {
        return $notifications->each(function ($notification) use ($log_message) {
            $device = Device::find($notification->data['device_id']);
            if ($device) {
                $device->info($log_message, [], [
                    'notification_id' => $notification->id,
                ]);
            }
        });
    }
}
