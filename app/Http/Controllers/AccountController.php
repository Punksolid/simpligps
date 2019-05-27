<?php

namespace App\Http\Controllers;

use App\Http\Resources\InternalNotificationResource;
use Illuminate\Http\Request;
use App\Http\Resources\AccessLogResource;
use App\User;
use App\Account;
use App\Http\Middleware\IsUserPermittedInAccountMiddleware;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(IsUserPermittedInAccountMiddleware::class);
    }

    public function accessLogs(Request $request)
    {
        $account_uuid =  $request->header('X-Tenant-Id', null);
        
        $logs = $request->tenant_account->activities()
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
        $account = $this->getAccount();
        $notifications = $account
            ->unreadNotifications()
            ->get();

        return InternalNotificationResource::collection($notifications);
    }

    public function markAsRead($uuid)
    {
        $this->getAccount()->notifications()->where('id', $uuid)->first()->markAsRead();
        return \response()->json(['data' => 'ok']);
    }

    public function getAccount(): ?Account
    {
        $account_uuid =  \request()->header('X-Tenant-Id', null);
        return \request()->user()->accounts()->where('uuid', $account_uuid)->firstOrFail();
    }
}
