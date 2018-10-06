<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\UpdateLocalizationRequest;
use App\Http\Resources\DeviceResource;
use App\Point;
use Illuminate\Http\Request;

class DevicesController extends Controller
{

    /**
     * Display a listing of the Devices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::paginate();

        return DeviceResource::collection($devices);
    }
    /**
     * Registra un dispositivo
     * @param DeviceRequest $request
     * @return DeviceResource
     */
    public function store(DeviceRequest $request)
    {
        $device = Device::create($request->all());

        return DeviceResource::make($device);
    }

    public function show(Device $device)
    {
        return DeviceResource::make($device->load(["trips"]));
    }

    /**
     * Actualiza los datos del dispositivo
     * @param DeviceRequest $request
     * @param Device $device
     * @return DeviceResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(DeviceRequest $request, Device $device)
    {
        if ($device->update($request->all())){
            return DeviceResource::make($device);
        }

        return response("Aconteció un error actualizando los datos del dispositivo.");
    }

    /**
     * Remove the specified DEVICE from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        if ($device->delete()){
            return response([
                "message" => "Se ha eliminado el registro del dispositivo"
            ]);
        }

        return response("Aconteció un error");
    }

    public function updateLocalization(Device $device, UpdateLocalizationRequest $request)
    {
//        $point = new Point();

        $device->points()->create([
            "lat" => $request->lat,
            "lon"  => $request->lon
        ]);

        return response()->json($device->load('points'));
    }

    public function storeExternal(DeviceRequest $request)
    {
        return $this->store($request);
    }

    /**
     * Lista dispositivos, api para uso externo
     * @return \Illuminate\Http\Response
     */
    public function listDevices()
    {
        return $this->index();
    }
}
