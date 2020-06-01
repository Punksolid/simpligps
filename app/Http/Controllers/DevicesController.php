<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Services\RegisterDevice;
use Illuminate\Http\Request;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\OpenApi;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Response;
use OpenApi\Annotations\Schema;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     *
     * @Get(
     *     path="/api/v1/devices",
     *     security={{
     *     "passport":{}
     *     },{
     *     "tenant":{}
     *     }},
     *     @RequestBody(
     *          @MediaType(mediaType="application/json")
     *     ),
     *     @Response(
     *      response="200",
     *      description="Display a paginated response of devices",
     *      @MediaType(
     *          mediaType="application/json",
     *          @Schema(ref="#/components/schemas/device"),
     *      )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $devices = Device::query();

        if ($request->has('name')) {
            $devices->where('name', 'LIKE', "$request->name%");
        }
        if ($request->has('gps')) {
            $devices->where('gps', 'LIKE', "$request->gps%");
        }
        if ($request->has('brand')) {
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
    public function store(DeviceRequest $request, RegisterDevice $registerDevice)
    {
        /** @var Device $device */
        $device = Device::make($request->all());
        $registerDevice->__invoke($request->all());
        $device->save();

        return DeviceResource::make($device);
    }

    public function show(Device $device)
    {
        $device = $device->load(['deviceable']);
        $device->position = [
                'lat' => $device->getLocation()['lat'],
                'lon' => $device->getLocation()['lon'],
            ];
        try {
            $device->is_connected = $device->linked(true);
        } catch (\Exception $exception) {
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
            return DeviceResource::make($device);
        }

        abort(500);
    }

    /**
     * @deprecated Usar index
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request)
    {
        $devices = Device::query()
            ->where('name', 'LIKE', "$request->name%")
            ->get([
                'id',
                'name',
            ]);

        return DeviceResource::collection($devices);
    }
}
