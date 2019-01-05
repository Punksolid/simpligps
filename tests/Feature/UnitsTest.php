<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitsTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $user = factory(User::class)->create();
        $this->actingAs($user, "api");
        $this->withoutMiddleware();
    }

    public function test_listar_unidades()
    {
        $this->withoutExceptionHandling();
        $call = $this->getJson("api/v1/units");

        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "name",
                    "measure_units",
                    "id"
                ]
            ]
        ]);
    }

    public function test_listar_unidades_con_sus_ubicaciones()
    {
        $call = $this->getJson("api/v1/units/with_localization");

        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "name",
                    "measure_units",
                    "id",
                    "position" => [
                        "lat",
                        "lon"
                    ]
                ]
            ]
        ]);
    }

    public function test_listar_resources_de_wialon()
    {

        $call = $this->getJson("api/v1/wialon/resources");

        $call->assertSuccessful();
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    'name'
                ]
            ]
        ]);
    }

}
