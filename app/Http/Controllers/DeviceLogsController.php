<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Resources\LogResource;
use Illuminate\Http\Request;

class DeviceLogsController extends Controller
{
    public function index(Device $device)
    {
//        $logs = $device->logs()->orderByDesc('created_at')->paginate(500);
        $logs = $device->activities()->orderByDesc('created_at')->paginate(100);
        return LogResource::collection($logs);
    }

    public function store(Device $device, Request $request)
    {
        $data = $request->validate([
            'message' => 'required|min:5'
        ]);
//        $log = $device->info($data['message']);
        activity()
            ->performedOn($device)
            ->withProperty('level', 'info')
            ->log($data['message']);
        return response()->json('ok');
//        return LogResource::make($log);
    }
}
