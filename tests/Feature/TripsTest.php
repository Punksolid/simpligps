<?php

namespace Tests\Feature;

use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripsTest extends TestCase
{

    public function test_crear_nuevo_viaje_manual()
    {

        $trip = [
            "rp" => $this->faker->name,
            "invoice" => $this->faker->randomNumber(5),
            "client" => $this->faker->company,
            "intermediary" => $this->faker->company,
            "origin" => $this->faker->address,
            "destination" => $this->faker->address,
            "mon_type" => $this->faker->randomNumber(1),
            "line" => $this->faker->company,

            "scheduled_load" => Carbon::now()->toDateTimeString(),
            "scheduled_departure" => Carbon::now()->toDateTimeString(),
            "scheduled_arrival" => Carbon::now()->addDays(2)->toDateTimeString(),
            "scheduled_unload" => Carbon::now()->addDays(3)->toDateTimeString()

        ];
        $call = $this->json("POST", "/api/v1/trips", $trip);
        $call->assertJson($trip);
        $call->assertStatus(200);

        return $call->getOriginalContent();
    }

    public function test_editar_viaje()
    {
        $trip_arr = $this->test_crear_nuevo_viaje_manual();

        $trip_modified = [
            "rp" => $this->faker->name,
            "invoice" => $this->faker->randomNumber(5),
            "client" => $this->faker->company,
            "intermediary" => $this->faker->company,
            "origin" => $this->faker->address,
            "destination" => $this->faker->address,
            "mon_type" => $this->faker->randomNumber(1),
            "line" => $this->faker->company,

            "scheduled_load" => Carbon::now()->toDateTimeString(),
            "scheduled_departure" => Carbon::now()->toDateTimeString(),
            "scheduled_arrival" => Carbon::now()->addDays(2)->toDateTimeString(),
            "scheduled_unload" => Carbon::now()->addDays(3)->toDateTimeString()

        ];
        $call = $this->json("PUT", "/api/v1/trips/".$trip_arr["id"], $trip_modified);
        $call->assertJson($trip_modified);
        $call->assertStatus(200);

        return $call->getOriginalContent();
    }

    public function test_usuario_elimina_viaje()
    {
        $trip_arr = $this->test_crear_nuevo_viaje_manual();

        $call = $this->json("DELETE", "/api/v1/trips/".$trip_arr["id"]);
        $call->assertJson([
            "message" => "eliminado"
        ]);
        $this->assertDatabaseMissing("trips",[
            "client" => $trip_arr["client"]
        ]);
        $call->assertStatus(200);

    }

    public function test_crear_importacion_de_plan_de_viaje()
    {
        $user = factory(User::class)->create();
        $trip = [
            "rp" => $this->faker->name,
            "invoice" => $this->faker->randomNumber(5),
            "client" => $this->faker->company,
            "intermediary" => $this->faker->company,
            "origin" => $this->faker->address,
            "destination" => $this->faker->address,
            "mon_type" => $this->faker->randomNumber(1),
            "line" => $this->faker->company,

            "scheduled_load" => Carbon::now()->toDateTimeString(),
            "scheduled_departure" => Carbon::now()->toDateTimeString(),
            "scheduled_arrival" => Carbon::now()->addDays(2)->toDateTimeString(),
            "scheduled_unload" => Carbon::now()->addDays(3)->toDateTimeString()

        ];
        $path = "/home/ps/Descargas/formatos de carga de viajes/";
        $name = "viajes(sin opciones).xlsx";
        $file = new UploadedFile($path.$name,$name);


        $call = $this->actingAs($user)->call(
            "POST",
            "/api/v1/trips/upload",
            [], [],
            ['viajes' => $file],
            ['Accept' => 'application/json']);

        $call->assertJson($trip);
    }

    public function test_ver_viajes_activos()
    {
        $trip = factory(Trip::class)->create();
        $call = $this->actingAs(factory(User::class)->create())->json("GET", "api/v1/trips?filter=active");
        dd($trip->toArray());
        $call->assertStatus(200)
            ->assertJsonFragment([

            ]);
    }

    public function test_ver_planes_de_viaje_por_etiqueta()
    {
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create(["tag" => "riesgo"]);

        $call = $this->actingAs($user)->json("POST", "/api/v1/trips/filtered_with_tags", [
            "tag" => "riesgo"
        ]);

        $call->assertSee($trip->rp);

    }
    public function test_ver_asignar_etiqueta_a_viaje()
    {
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create();

        $etiqueta = "riesgo";
        $call = $this->actingAs($user)->json("POST", "/api/v1/trips/{$trip->id}/tags", [
            "tag" => $etiqueta
        ]);

        $call->assertSee("riesgo");
        $call->assertStatus(200);
    }
    public function test_stringvacio()
    {
        $call = $this->json("PUT", "api/stringvacio", [
            "hola" => ""
        ])->dump();
    }
}
