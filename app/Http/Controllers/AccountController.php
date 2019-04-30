<?php

namespace App\Http\Controllers;

use App\Http\Resources\InternalNotificationResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * Devuelve las notificaciones internas del sistema del usuario, las estandar de Laravel
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getNotifications()
    {
        $account_uuid =  \request()->header('X-Tenant-Id', null);
        $account = \request()->user()->accounts()->where('uuid', $account_uuid)->firstOrFail();
        $notifications = $account
            ->unreadNotifications()
//            ->where('data->X-Tenant-Id', $account)
            ->get();

        return InternalNotificationResource::collection($notifications);
    }

    public function markAsRead($uuid)
    {
        try {
            auth()->user()->notifications()->where('id', $uuid)->first()->markAsRead();
            return \response()->json(['data' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('Failed mark as read', $e->getMessage());
            return response()->json([
                'message' => 'An error occurred'
            ]);
        }
    }
}
