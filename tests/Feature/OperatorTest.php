<?php

namespace Tests\Feature;

use App\Carrier;
use App\Operator;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OperatorTest extends TestCase
{
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
        $call = $this->actingAs(factory(User::class)->create())
            ->json("POST", "/api/v1/operators", $operator_data);

        $call->assertJson($operator_data);
        $call->assertStatus(200);


    }

    public function test_editar_operador()
    {
        $operator = factory(Operator::class)->create(["name" => "pedro"]);
        $operator_modified = factory(Operator::class)->make();
        $operator_modified->carrier_id = factory(Carrier::class)->create()->id;
        $call = $this->actingAs(factory(User::class)->create())
            ->json("PUT", "api/v1/operators/$operator->id",
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

        $call = $this->actingAs(factory(User::class)->create())
            ->json("GET", "api/v1/operators/$operator->id");

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
        $call = $this->actingAs(factory(User::class)->create())
            ->json("GET", "/api/v1/operators");

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
        $call = $this->actingAs(factory(User::class)->create())
            ->json("DELETE", "api/v1/operators/$operador->id");

        $call->assertJson([
            "message" => "El operador ha sido eliminado con éxito."
        ]);
        $call->assertStatus(200);
    }

}
