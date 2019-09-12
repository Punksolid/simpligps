<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\AccessLogResource;
use App\Account;
use App\Http\Middleware\IsUserPermittedInAccountMiddleware;
use Spatie\Activitylog\Models\Activity;

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
            ->orderBy('id', 'DESC')
            ->paginate();

        return AccessLogResource::collection($logs);
    }

    public function getAccount(): ?Account
    {
        $account_uuid = \request()->header('X-Tenant-Id', null);

        return \request()->user()->accounts()->where('uuid', $account_uuid)->firstOrFail();
    }
}
