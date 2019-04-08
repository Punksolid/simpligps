<?php

namespace Tests\Feature;

use App\Carrier;
use App\Device;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Place;
use App\Trip;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class TripsTest extends TestCase
{
    var $user;

    protected function setUp():void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user,"api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);

    }

    public function test_crear_nuevo_viaje_manual()
    {
        $trip = [
            "rp" => $this->faker->name,
            "invoice" => $this->faker->randomNumber(5),
            "client" => $this->faker->company,
            "device_id" => factory(Device::class)->create()->id,
            "intermediates" => [
                factory(Place::class)->create()->id,
                factory(Place::class)->create()->id,
            ],
            "origin_id" => factory(Place::class)->create()->id,
            "destination_id" => factory(Place::class)->create()->id,

            "mon_type" => $this->faker->randomNumber(1),
            "carrier_id" => factory(Carrier::class)->create()->id,

            "scheduled_load" => Carbon::now()->toDateString(),
            "scheduled_departure" => Carbon::now()->addDays(1)->toDateString(),
            "scheduled_arrival" => Carbon::now()->addDays(2)->toDateString(),
            "scheduled_unload" => Carbon::now()->addDays(3)->toDateString()


        ];
        $this->withoutExceptionHandling();
        $call = $this->postJson( "/api/v1/trips", $trip);

        $call->assertSuccessful();
        $call->assertJsonStructure([
            'data' => [
                'device_id',
                'rp',
                'invoice',
                'client',
                'origin_id',
                'destination_id',

                'mon_type',
                'carrier_id',

                "scheduled_load",
                "scheduled_departure",
                "scheduled_arrival",
                "scheduled_unload"

            ]
        ]);
    }

    public function test_ver_detalles_de_un_viaje()
    {
        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->create([
            'origin_id' => factory(Place::class)->create()->id,
            'destination_id' => factory(Place::class)->create()->id,
            'device_id' => factory(Device::class)->create()->id
        ]);

        $call = $this->getJson("api/v1/trips/{$trip->id}");

        $call->assertSuccessful();
        $call->assertJsonStructure([
            "data" => [
                'id',
                'rp',
                'invoice',
                'client',
                'origin_id',
                'destination_id',

                'mon_type',
                'line',

                "scheduled_load",
                "scheduled_departure",
                "scheduled_arrival",
                "scheduled_unload",
                "origin" => [
                    "id",
                    "name"
                ],
                "destination" => [
                    "id",
                    "name"
                ],
                "intermediates" => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ],
                "device" => [
                    'id'
                ]
            ]
        ]);

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
            "scheduled_departure" => Carbon::now()->addDays(1)->toDateTimeString(),
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
        ],"tenant");
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
            "scheduled_departure" => Carbon::now()->addDays(1)->toDateTimeString(),
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
        $trip->attachTag("active");
        $call = $this
            ->actingAs(factory(User::class)->create())
            ->getJson("api/v1/trips?filter=active");


        $call->assertJsonFragment([
             "id" => $trip->id,
             "rp" => $trip->rp
            ]);

        $call->assertStatus(200);
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

}
