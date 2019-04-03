<?php

namespace App\Http\Controllers;

use App\Device;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function resume()
    {
        $users = User::tenant()->count(); // TODO add Cache
        $devices = Device::count(); // TODO add Cache

        return response()->json([
            'data' => compact('users','devices')
        ]);
    }
}
