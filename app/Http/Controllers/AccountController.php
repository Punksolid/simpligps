<?php

namespace App\Http\Controllers;

use App\Http\Resources\InternalNotificationResource;
use Illuminate\Http\Request;
use App\Http\Resources\AccessLogResource;
use App\User;

class AccountController extends Controller
{
    public function accessLogs(Request $request)
    {
        $account_uuid =  \request()->header('X-Tenant-Id', null);
        $account = \request()->user()->accounts()->where('uuid', $account_uuid)->firstOrFail();
        $logs = $account->activities()
        ->where('log_name', 'access_log')
        ->paginate();        
        // $logs = \Spatie\Activitylog\Models\Activity::
        //         where('log_name', 'access_log')
        //         // @TODO: select by account
        //         ->paginate();
        // $logs = $account->activities()
        // ->where('log_name', 'access_log')
        // ->paginate();
        return AccessLogResource::collection($logs);
    }

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
