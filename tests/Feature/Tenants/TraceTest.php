<?php

namespace Tests\Feature;

use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class TraceTest extends TestCase
{
    public $trip;

    protected function setUp():void
{

        parent::setUp(); // TODO: Change the autogenerated stub

        $this->trip = factory(Trip::class)->create();
        $this->be(factory(User::class)->create(),"api");
    }

    public function test_grabar_bitacora()
    {

        $trace = [
            "date" => Carbon::now()->toDateTimeString(),
            "localization" => "{$this->faker->latitude},{$this->faker->longitude}",
            "notes" => $this->faker->paragraph,
            "status" => $this->faker->boolean,
            "situation" => $this->faker->paragraph,
        ];
        $call = $this->postJson("/api/v1/trips/{$this->trip->id}/traces", $trace);
        $call->assertJson([
            "data" => $trace
            ]
        );


        return $call->getOriginalContent();
    }

    public function test_ver_bitacora_de_un_viaje()
    {

        $trace = $this->test_grabar_bitacora();

        $call = $this->getJson( "/api/v1/trips/{$this->trip->id}/traces");
        $call->assertJsonFragment([
            "notes" => $trace->content["notes"]
        ]);
        $call->assertStatus(200);

        return $call->getOriginalContent();
    }
}
