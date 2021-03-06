<?php

namespace Tests\Feature;

use App\Carrier;
use App\Device;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Services\RegisterDevice;
use App\Services\Traccar;
use App\User;
use Punksolid\Wialon\Unit;
use Tests\Tenants\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TruckTract;

class DevicesTest extends TestCase
{
    var $user;

    public function deviceForm(): array
    {
        return  [
            "name" => $this->faker->name. $this->faker->unique()->randomNumber(5),
            "internal_number" => $this->faker->randomNumber(6).$this->faker->unique()->randomNumber(4),
            "gps" => $this->faker->company,
        ];
    }

    protected function setUp():void
    {

        parent::setUp(); // TODO: Change the autogenerated stub
        $event = User::getEventDispatcher();
        User::unsetEventDispatcher();
        $this->user = factory(User::class)->create();
        User::setEventDispatcher($event);
        $this->actingAs($this->user, "api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);
        config([
            "services.wialon.token" => "5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8"
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_registrar_un_nuevo_dispositivo(): void
    {
        $this->withoutExceptionHandling();
        $register_device = \Mockery::mock(RegisterDevice::class)->makePartial();
        $register_device->shouldReceive('__invoke')->andReturn([]);
        $this->app->instance(RegisterDevice::class,$register_device);

        $device_form = $this->deviceForm();

        $call = $this->postJson("api/v1/devices", $device_form);
        $call->assertJsonFragment($device_form);

    }


    public function test_usuario_puede_ver_detalles_de_un_solo_dispositivo(): void
    {
        $this->withoutExceptionHandling();
        $device = factory(Device::class)->create();

        $call = $this->getJson("api/v1/devices/$device->id");

        $call->assertJson([
            "data" => [
                "name" => $device->name,
                "internal_number" => $device->internal_number,
                "gps" => $device->gps
            ]
        ]);

        $call->assertJsonStructure([
            "data" => [
                "internal_number",
                "gps",
                "name",
                "reference_data",
                "is_connected",
                'position' => [
                    'lat',
                    'lon'
                ]
            ]
        ]);
    }

    public function test_usuario_puede_ver_truck_del_dispositivo_cuando_esta_asignado()
    {
        $this->withoutExceptionHandling();
        $device = factory(Device::class)->create();
        $truck = factory(TruckTract::class)->create();
        $truck->assignDevice($device);
        $call = $this->getJson("api/v1/devices/$device->id");
        
        $call->assertJsonStructure([
            "data" => [
                "truck" => [ //TRUCK
                    'name',
                    'plate',
                    'model',
                    'internal_number',
                    'brand',
                    'color'
                ]
            ]
        ]);

        $call->assertJsonFragment([
            'name' => $truck->name,
            'plate' => $truck->plate,
            'model' => $truck->model,
            'internal_number' => $truck->internal_number,
            'brand' => $truck->brand,
            'gps' => $truck->gps,
            'color' => $truck->color,
        ]);
    }

    public function test_no_asginar_un_dispositivo_ya_asignado()
    {
        $device = factory(Device::class)->create();
        $camion_viejo = factory(TruckTract::class)->create();
        $camion_viejo->assignDevice($device);
        $device = $device->fresh();
        $camion_nuevo = factory(TruckTract::class)->create();

        $call = $this->putJson('api/v1/trucks/'.$camion_nuevo->id, [
            'name' => $this->faker->name,
            'plate' => $this->faker->numberBetween(10000,99999),
            'model' => $this->faker->shuffleString('calkahsdlkfha'),
            'internal_number' => $this->faker->word,
            'brand' => $this->faker->word,
            'gps' => $this->faker->word,
            'color' => $this->faker->colorName,
            'carrier_id' => factory(Carrier::class)->create()->id,
            'device_id' => $device->id
        ]);

        $device = $device->fresh();
        $camion_viejo = $camion_viejo->fresh('device');
        $this->assertNull($camion_viejo->device);
        $this->assertEquals($camion_nuevo->device,$device);

    }

    public function test_listar_dispositivos_paginados()
    {
        $this->withoutExceptionHandling();
        $call = $this->getJson("api/v1/devices");
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "internal_number",
                    "gps"
                ]
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_editar_registro_de_dispositivo()
    {
        $device = factory(Device::class)->create();
        $new_device = $this->deviceForm();
        
        $call = $this->putJson("api/v1/devices/$device->id", $new_device);
        $call->assertJsonFragment($new_device);
        $call->assertStatus(200);
    }

    public function test_destruir_dispositivo()
    {
        $this->withoutExceptionHandling();
        $device = factory(Device::class)->create();
        $call = $this->deleteJson("api/v1/devices/$device->id");

        $this->assertSoftDeleted("devices", [
            "name" => $device->name
        ],'tenant');
        $call->assertStatus(200);

    }

    public function test_ligar_unidad_wialon_a_device(): void
    {

        $unit = Unit::all()->first();
        $device = factory(Device::class)->create();

        $call = $this->postJson("api/v1/devices/{$device->id}/link_unit",[
           "unit_id" => $unit->id
        ]);

        $call->assertJsonStructure([
            "data" => [
                "name",
                "reference_data" => [
                    "id",
                    "nm"
                ]
            ]
        ]);

        $call->assertJsonFragment([
            "nm" => $unit->nm
        ]);
    }

    public function test_ver_posicion_de_device_ligado(): void
    {
        $this->withoutExceptionHandling();
        $traccar = $this->mock(Traccar::class)
            ->makePartial();
        $traccar->shouldReceive('isConfigured')->andReturnFalse();

        $this->app->instance(Traccar::class, $traccar);

//        $unit = Unit::all()->first();
        /** @var Unit $unit */
        $unit = $this->partialMock(Unit::class, function ($mock){
            $mock->id = 536;
            $mock->lat = 52.31839;
            $mock->lon = 9.81065;
        });

        $device = factory(Device::class)->create();
        $device->linkUnit($unit);

        $call = $this->getJson('api/v1/devices/'.$device->id);

        $call->assertJsonFragment([
            'lat' => $unit->lat,
            'lon' => $unit->lon
        ]);

    }

    public function test_puede_buscar_dispositivos_por_nombre()
    {
        $device = factory(Device::class)->create();

        $call = $this->getJson("api/v1/devices/search?name=$device->name");

        $call->assertSuccessful();
        $call->assertJsonFragment([
            'name' => $device->name
        ]);

    }

}
