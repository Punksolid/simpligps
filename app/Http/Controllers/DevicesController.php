<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\UpdateLocalizationRequest;
use App\Http\Resources\DeviceResource;
use App\Point;
use Illuminate\Http\Request;
use Punksolid\Wialon\Unit;
use App\Interfaces\SearchInterface;

/**
 * Class DevicesController
 * @package App\Http\Controllers
 * @resource Device
 */
class DevicesController extends Controller implements SearchInterface
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
        
        if ($device) {
            $unit = Unit::make($request->name);
            $device->update(["reference_data" => $unit]);
        }
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
        if ($device->update($request->all())) {
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
        if (isset($device->reference_data["id"])) {
            //            try {
            //
            //                $unit = Unit::find($device->reference_data["id"]);
            //                if ($unit){
            //                    $unit->destroy();
            //                }
            //            } catch (\Exception $exception) {
            //                \Log::warning("Failing destroying unit",[
            //                    "wialon_unit" => $unit
            //                ]);
            //            }
        }
        if ($device->delete()) {
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

    /**
     * Liga unidad a dispositivos existentes
     * @param Device $device
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function linkUnit(Device $device, Request $request)
    {
        $unit = Unit::find($request->unit_id);
        if ($device->linkUnit($unit)) {
            return response()->json([
                "data" => $device
            ]);
        }

        abort(500);
    }

    public function search(Request $request)
    {
        $devices = Device::query()
            ->where('name', 'LIKE', "%{$request->name}%")
            ->get();

        return DeviceResource::collection($devices);
    }
}
