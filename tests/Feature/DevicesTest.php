<?php

namespace Tests\Feature;

use App\Carrier;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_registrar_un_nuevo_dispositivo()
    {
        $device = [
            "internal_number" => $this->faker->randomNumber(6) ,
            "gps" => $this->faker->company,
            "carrier_id" => factory(Carrier::class)->create()->id,
            "plate" => $this->faker->randomNumber(7)
        ];

        $call = $this->actingAs(factory(User::class)->create())->json("POST","api/v1/devices",$device);

        $call->assertJsonFragment($device);
        $call->assertStatus(201);

        return $call->getOriginalContent();
    }

    public function test_usuario_puede_ver_detalles_de_un_solo_dispositivo()
    {
        $device = $this->test_registrar_un_nuevo_dispositivo();

        $call = $this->actingAs(factory(User::class)->create())->json("GET","api/v1/devices/$device->id");

        $call->assertJson([
            "data" => [
                "internal_number" => $device->internal_number,
                "gps" => $device->gps,
                "carrier_id" => $device->carrier_id,
                "plate" => $device->plate,

            ]
        ]);

    }

    public function test_listar_dispositivos_paginados()
    {
        $call = $this->actingAs(factory(User::class)->create())->json("GET", "api/v1/devices");
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "internal_number",
                    "gps",
                    "carrier_id",
                    "plate"
                ]
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_editar_registro_de_dispositivo()
    {
        $device = $this->test_registrar_un_nuevo_dispositivo();
        $new_device = [
            "internal_number" => $this->faker->randomNumber(6) ,
            "gps" => $this->faker->company,
            "carrier_id" => factory(Carrier::class)->create()->id,
            "plate" => $this->faker->randomNumber(7)
        ];

        $call = $this->actingAs(factory(User::class)->create())->json("PUT","api/v1/devices/$device->id",$new_device);

        $call->assertJsonFragment($new_device);
        $call->assertStatus(200);
    }

    public function test_olvidar_dispotivio()
    {
        $device = $this->test_registrar_un_nuevo_dispositivo();
        $call = $this->actingAs(factory(User::class)->create())
            ->json("DELETE","api/v1/devices/$device->id");

        $this->assertDatabaseMissing("devices",[
            "internal_number" => $device->internal_number
        ]);
        $call->assertStatus(200);

    }
}
