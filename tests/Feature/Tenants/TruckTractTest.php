<?php

namespace Tests\Feature;

use App\Carrier;
use App\Device;
use App\Operator;
use App\Trip;
use App\TruckTract;
use Punksolid\Wialon\Unit;
use Tests\Tenants\TestCase;

class TruckTractTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        config([
            "services.wialon.token" => "5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8"
        ]);
    }

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
        $truck_form = factory(TruckTract::class)->raw([
            'device_id' => factory(Device::class)->create()->id
        ]);

        $call = $this->postJson('api/v1/trucks', $truck_form);
        unset($truck_form['device_id']);

        $call->assertJsonFragment($truck_form);
    }

    public function test_crear_tract_solo_con_campos_minimos_obligatorios()
    {
//        Placa, nombre, device y Carrier, internal number
        $form = [
            'plate' => $this->faker->numberBetween(00000, 999999),
            'name' => $this->faker->word,
            'internal_number' => $this->faker->bankAccountNumber,
            'device_id' => factory(Device::class)->create()->id,
            'carrier_id' => factory(Carrier::class)->create()->id,
        ];

        $call = $this->postJson('api/v1/trucks', $form);
        $call->assertSuccessful();
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
        $unit = Unit::all()->first();
        $device->linkUnit($unit);

        $truck = factory(TruckTract::class)->create();
        $truck->assignDevice($device);

        $call = $this->getJson("api/v1/trucks/$truck->id");

        $call->assertJsonFragment([
            "name" => $device->name,
            "internal_number" => (string)$device->internal_number,
            "brand" => $device->brand,
            "model" => $device->model,
            "gps" => $device->gps
        ]);

        $call->assertJsonStructure([
            'data' => [
                'name',
                'position' => [
                    'lat',
                    'lon'
                ]
            ]
        ]);

        $call->assertJsonFragment([
            'lat' => $unit->lat,
            'lon' => $unit->lon
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
        ]);
        $past_trip = factory(Trip::class)->create([
            "operator_id" => $some_other_operator->id,
            "truck_tract_id" => $truck->id,
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
        $new = factory(TruckTract::class)->raw([
            'device_id' => factory(Device::class)->create()->id
        ]);
        $call = $this->putJson("api/v1/trucks/$truck->id", $new);
        unset($new['device_id']);
        $call->assertJsonFragment($new);
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
