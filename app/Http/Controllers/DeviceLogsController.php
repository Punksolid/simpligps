<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Resources\LogResource;
use Illuminate\Http\Request;

class DeviceLogsController extends Controller
{
    public function index(Device $device)
    {
        return LogResource::collection($device->logs);
    }

    public function store(Device $device, Request $request) {
        $data = $request->validate([
            'message' => 'required|min:5'
        ]);
        $log = $device->info($data['message']);
        return LogResource::make($log);
    }
}
