<?php

namespace Tests\Feature;

use App\Carrier;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Operator;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class OperatorTest extends TestCase
{
    var $user;

    protected function setUp():void
{
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user,"api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);

    }
    /**
     * Crear operador
     *
     * @return void
     */
    public function test_crear_operador()
    {
        $operator_data = [
            "name" => $this->faker->name,
            "phone" => $this->faker->phoneNumber,
            "active" => $this->faker->boolean,
            "carrier_id" => factory(Carrier::class)->create()->id
        ];
        $call = $this->json("POST", "/api/v1/operators", $operator_data);

        $call->assertJson($operator_data);
        $call->assertStatus(200);


    }

    public function test_editar_operador()
    {
        $operator = factory(Operator::class)->create(["name" => "pedro"]);
        $operator_modified = factory(Operator::class)->make();
        $operator_modified->carrier_id = factory(Carrier::class)->create()->id;
        $call = $this->json("PUT", "api/v1/operators/$operator->id",
                $operator_modified->toArray()
            );

        $call->assertJson([
            "data" => [
                "name" => $operator_modified->name
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_ver_detalle_de_un_solo_operador()
    {
        $operator = factory(Operator::class)->create([
            "carrier_id" => factory(Carrier::class)->create()->id
        ]);

        $call = $this->json("GET", "api/v1/operators/$operator->id");

        $call
            ->assertJson([
            "data" => [
                "name" => $operator->name,
                "phone" => $operator->phone,
                "active" => (bool)$operator->active
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_listar_operadores()
    {
        $call = $this->json("GET", "/api/v1/operators");

        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "name",
                    "phone",
                    "active"
                ]
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_eliminar_operador()
    {

        $operador = factory(Operator::class)->create();
        $call = $this->json("DELETE", "api/v1/operators/$operador->id");

        $call->assertJson([
            "message" => "El operador ha sido eliminado con éxito."
        ]);
        $call->assertStatus(200);
    }

}
