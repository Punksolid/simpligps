<?php

namespace Tests\Feature;

use App\Trip;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConvoyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_convoy()
    {
        $trips_ids = factory(Trip::class,3)->create()->pluck("id")->toArray();

        $call = $this->json("POST", "/api/v1/trips/convoys", [
            "trips_ids" => $trips_ids
        ]);

        $call->assertSee($trips_ids[0]);
        $call->assertStatus(200);

        return [$call->getOriginalContent(),$trips_ids];
    }

    public function test_usuario_puede_ver_detalle_de_convoy()
    {
        list($convoy,$trips_ids) = $this->test_crear_convoy();

        $call = $this->json("GET", "/api/v1/trips/convoys/$convoy->id");

        $call->assertSee($trips_ids[0]);
        $call->assertStatus(200);
    }

    public function test_listado_de_convoys()
    {
        list($convoy,$trips_ids) = $this->test_crear_convoy();

        $call = $this->json("GET", "/api/v1/trips/convoys");

        $call->assertSee($trips_ids[0]);
        $call->assertStatus(200);
    }


}
