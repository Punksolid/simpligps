<?php

namespace Tests\Feature;

use App\TruckTract;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;
use App\Device;
use App\Operator;
use App\Trip;
use Carbon\Carbon;

class TruckTractTest extends TestCase
{
    public function test_listar_tracto_camiones()
    {
        factory(TruckTract::class)->create();

        $call = $this->getJson('api/v1/trucks');

        $call->assertJsonStructure([
            'data' => [
                "*" => [
                    'id',
                    'name',
                    'plate',
                    'model',
                    'internal_number',
                    'brand',
                    'gps',
                    'carrier_id',
                    'color',
                    'device_id'
                ]
            ]
        ]);
    }

    public function test_crear_tracto()
    {
        $this->withoutExceptionHandling();
        $truck = factory(TruckTract::class)->make();

        $call = $this->postJson('api/v1/trucks', $truck->toArray());

        $call->assertJsonFragment($truck->toArray());
    }


    public function test_ver_detalles_de_tracto()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->getJson("api/v1/trucks/$truck->id");
        $call->assertJsonStructure([
            'data' =>
            [
                'name',
                'plate',
                'model',
                'internal_number',
                'brand',
                'gps',
                'color'
            ]
        ]);
        $call->assertJsonFragment($truck->toArray());
    }

    public function test_al_ver_detalles_del_tracto_puede_ver_dispositivo_asociado()
    {
        $device = factory(Device::class)->create();
        $truck = factory(TruckTract::class)->create([
            "device_id" => $device->id
        ]);

        $call = $this->getJson("api/v1/trucks/$truck->id");

        $call->assertJsonFragment([
            "name" => $device->name,
            "internal_number" => $device->internal_number,
            "brand" => $device->brand,
            "model" => $device->model,
            "gps" => $device->gps
        ]);
    }

    public function test_usuario_puede_ver_el_operador_asociado_a_un_truck_que_esta_en_viaje()
    {
        $truck = factory(TruckTract::class)->create();
        $operator = factory(Operator::class)->create();
        $some_other_operator = factory(Operator::class)->create();

        $trip = factory(Trip::class)->create([
            "operator_id" => $operator->id,
            "truck_tract_id" => $truck->id,
            "scheduled_load" => Carbon::yesterday(),
            "scheduled_unload" => Carbon::tomorrow()
        ]);
        $past_trip = factory(Trip::class)->create([
            "operator_id" => $some_other_operator->id,
            "truck_tract_id" => $truck->id,
            "scheduled_load" => Carbon::now()->subYear(1),
            "scheduled_unload" => Carbon::now()->subWeek(1)
        ]);

        $call = $this->getJson("api/v1/trucks/$truck->id");
        $call->assertJsonFragment([
            "current_operator" => [
                "id" => $operator->id,
                "name" => $operator->name,
                "phone" => $operator->phone,
                "active" => $operator->active
            ]
        ]);
    }

    public function test_actualizar_detalles_de_tracto()
    {

        $truck = factory(TruckTract::class)->create();
        $new = factory(TruckTract::class)->make();
        $call = $this->putJson("api/v1/trucks/$truck->id", $new->toArray());

        $call->assertJsonFragment($new->toArray());
    }

    public function test_eliminar_tracto()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->deleteJson("api/v1/trucks/$truck->id");

        $call->assertSuccessful();
    }

    public function test_puede_buscar_tracto_por_placa()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->getJson("api/v1/trucks/search?plate=$truck->plate");

        $call->assertSuccessful();
        $call->assertJsonFragment([
            'plate' => $truck->plate
        ]);
    }
    public function test_puede_buscar_tracto_por_nombre()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->getJson("api/v1/trucks/search?name=$truck->name");

        $call->assertSuccessful();
        $call->assertJsonFragment([
            'name' => $truck->name
        ]);
    }
}
