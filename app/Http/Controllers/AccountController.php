<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\AccessLogResource;
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

    public function getAccount(): ?Account
    {
        $account_uuid = \request()->header('X-Tenant-Id', null);

        return \request()->user()->accounts()->where('uuid', $account_uuid)->firstOrFail();
    }
}
