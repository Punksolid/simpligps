<?php

namespace App\Http\Controllers;

use App\User;

class DashboardController extends Controller
{
    public function resume()
    {
        $devices = \DB::connection('tenant')
                    ->table('devices')
                    ->selectRaw('count(*) as total')
                    ->first();

        $users = User::tenant()->count(); // TODO add Cache

        return response()->json([
            'data' => [
                'users' => $users,
                'devices' => $devices->total,
            ],
        ]);
    }
}
