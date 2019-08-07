<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\UpdateLocalizationRequest;
use App\Http\Resources\DeviceResource;
use App\Point;
use Illuminate\Http\Request;
use Punksolid\Wialon\Unit;
use App\Interfaces\Search;

/**
 * Class DevicesController.
 *
 * @resource Device
 */
class DevicesController extends Controller implements Search
{
    /**
     * Display a listing of the Devices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $devices = Device::query();
        if ($request->has('name')){
            $devices->where('name', 'LIKE', "$request->name%");
        }
        if ($request->has('gps')){
            $devices->where('gps', 'LIKE', "$request->gps%");
        }
        if ($request->has('brand')){
            $devices->where('brand', 'LIKE', "$request->brand%");
        }

        return DeviceResource::collection($devices->paginate());
    }

    /**
     * Registra un dispositivo.
     *
     * @param DeviceRequest $request
     *
     * @return DeviceResource
     */
    public function store(DeviceRequest $request)
    {
        $device = Device::create($request->all());

        try {
            $unit = Unit::make($request->name);
        } catch (\Exception $exception) {
            \Log::warning('Couldnt create a unit in wialon', [
                'device' => $device->toArray(),
            ]);
        }

        if (isset($unit)) {
            $device->update(['reference_data' => $unit]);
        }

        return DeviceResource::make($device);
    }

    public function show(Device $device)
    {
        $device = $device->load(['deviceable']);
        $device->position = [
                'lat' => $device->getLocation()['lat'],
                'lon' => $device->getLocation()['lon']
            ];
        try{
            $device->is_connected = $device->linked(true);
        } catch (\Exception $e){
            $device->is_connected = false;
        }
        return DeviceResource::make($device);
    }

    /**
     * Actualiza los datos del dispositivo.
     *
     * @param DeviceRequest $request
     * @param Device        $device
     *
     * @return DeviceResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(DeviceRequest $request, Device $device)
    {
        if ($device->update($request->all())) {
            return DeviceResource::make($device);
        }

        return response('Aconteció un error actualizando los datos del dispositivo.');
    }

    /**
     * Remove the specified DEVICE from storage.
     *
     * @param \App\Device $device
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        if ($device->delete()) {
            return response([
                'message' => 'Se ha eliminado el registro del dispositivo',
            ]);
        }

        return response('Aconteció un error');
    }

    public function updateLocalization(Device $device, UpdateLocalizationRequest $request)
    {
        //        $point = new Point();

        $device->points()->create([
            'lat' => $request->lat,
            'lon' => $request->lon,
        ]);

        return response()->json($device->load('points'));
    }

    /**
     * Liga unidad a dispositivos existentes.
     *
     * @param Device  $device
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function linkUnit(Device $device, Request $request)
    {
        $unit = Unit::find($request->unit_id);
        if ($device->linkUnit($unit)) {
            return response()->json([
                'data' => $device,
            ]);
        }

        abort(500);
    }

    public function search(Request $request)
    {
        $devices = Device::query()
            ->where('name', 'LIKE', "$request->name%")
            ->get([
                'id',
                'name'
            ]);

        return DeviceResource::collection($devices);
    }
}
