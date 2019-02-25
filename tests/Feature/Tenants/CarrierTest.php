<?php

namespace Tests\Feature;

use App\Account;
use App\Carrier;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property mixed account
 */
class CarrierTest extends \Tests\Tenants\TestCase
{
    var $user;
    var $account;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create(); // crea un usuario
        $this->actingAs($this->user, "api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);
        $this->account = factory(Account::class)->create(); // crea una cuenta

        $this->user->attachAccount($this->account);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_linea_transportista()
    {
        $this->withoutExceptionHandling();
        $carrier = [
            "carrier_name" => $this->faker->company,
            "contact_name" => $this->faker->name,
            "phone" => $this->faker->phoneNumber,
            "email" => $this->faker->email
        ];

        $call = $this->postJson("api/v1/carriers", $carrier,[
            'X-Tenant-Id' => $this->website->uuid
        ]);
        $call->assertJsonFragment($carrier);
        $call->assertStatus(201);
    }

    public function test_editar_linea_transportista()
    {
        $new_carrier = [
            "carrier_name" => $this->faker->company,
            "contact_name" => $this->faker->name,
            "phone" => $this->faker->phoneNumber,
            "email" => $this->faker->email
        ];
        $carrier = factory(Carrier::class)->create();
        $call = $this->putJson("api/v1/carriers/$carrier->id", $new_carrier);


        $call->assertJsonFragment($new_carrier);
        $call->assertStatus(200);
    }

    public function test_eliminar_linea_transportista()
    {
        $carrier = factory(Carrier::class)->create();
        $call = $this->deleteJson("api/v1/carriers/$carrier->id");
        usleep(500); //previene falsos positivos
        $this->assertDatabaseMissing("carriers", [
            "carrier_name" => $carrier->carrier_name
        ],'tenant');

    }

    public function test_listar_lineas_transportistas()
    {
        $call = $this->getJson("api/v1/carriers");
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "carrier_name",
                    "contact_name",
                    "phone",
                    "email"
                ]
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_ver_detalle_de_una_linea_de_transporte()
    {
        $carrier = factory(Carrier::class)->create();

        $call = $this->getJson("api/v1/carriers/$carrier->id");

        $call->assertJson([
            "data" => [
                "carrier_name" => $carrier->carrier_name,
                "contact_name" => $carrier->contact_name,
                "phone" => $carrier->phone,
                "email" => $carrier->email
            ]
        ]);
        $call->assertStatus(200);
    }
}