<?php

namespace Tests\Feature;

use App\Device;
use App\Http\Middleware\SetWialonTokenMiddleware;
use App\Place;
use App\Trip;
use App\TruckTract;
use Punksolid\Wialon\Resource;
use Tests\Tenants\TestCase;

class TripActionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutMiddleware([
           SetWialonTokenMiddleware::class
        ]);
        config(["services.wialon.token" => "11b6e71f234078f1ca9e6944705a235bB6C1D1F551E3E263783A2354A63236306018E83E"]);

    }

    public function test_stop_actualizaciones_automaticas_de_un_viaje()
    {
        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->create();
        $truck = factory(TruckTract::class)->create();
        $truck->assignDevice(factory(Device::class)->create(['wialon_id' => '17471332']));
        $trip->setOrigin(factory(Place::class)->create(['geofence_ref' => '17471233_4']), now()->addDays(1),now()->addDays(2));
        $trip->setDestination(factory(Place::class)->create(['geofence_ref' => '17471233_6']), now()->addDays(4),now()->addDays(5));
        $trip->update(['truck_tract_id' => $truck->id]);

        $trip->wialon_trips->createWialonNotificationsForTrips();
        $resource = Resource::findByName($trip->wialon_trips->resource_name);

        $this->assertEquals($trip->wialon_trips->resource_name,$resource->nm);

        $call = $this->deleteJson("/api/v1/trips/$trip->id/automatic_updates");

        $call->assertSuccessful();

        $resource = Resource::findByName($trip->wialon_trips->resource_name);

        $this->assertNull($resource);
    }

    public function test_dar_salida_a_un_viaje()
    {
        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->create();

        $truck = factory(TruckTract::class)->create();
        $truck->assignDevice(factory(Device::class)->create(['wialon_id' => '17471332']));

        $trip->setOrigin(factory(Place::class)->create(['geofence_ref' => '17471233_4']), now()->addDays(1),now()->addDays(2));
        $trip->setDestination(factory(Place::class)->create(['geofence_ref' => '17471233_6']), now()->addDays(4),now()->addDays(5));


        $trip->update(['truck_tract_id' => $truck->id]);


        $call = $this->postJson("api/v1/trips/$trip->id/give_exit", [
            "enable_automatic_updates" => true
        ]);

        $call->assertSuccessful();
    }

    public function test_no_puede_dar_salida_a_un_viaje_si_le_falta_ligar_dispositivos()
    {
        $truck = factory(TruckTract::class)->create();
        $truck->assignDevice($device = factory(Device::class)->create());
        $trip = factory(Trip::class)->create([
            'truck_tract_id' => $truck->id
        ]);

        $trip->setOrigin(factory(Place::class)->create(['geofence_ref' => '17471233_4']), now()->addDays(1),now()->addDays(2));
        $trip->setDestination(factory(Place::class)->create(['geofence_ref' => '17471233_6']), now()->addDays(4),now()->addDays(5));

        $call = $this->postJson("api/v1/trips/$trip->id/give_exit", [
            "enable_automatic_updates" => true
        ]);
        $call->assertJsonValidationErrors([
            "device" => "The device $device->name can't connect to wialon."
        ]);

    }

    public function test_no_puede_dar_salida_a_un_viaje_si_le_falta_ligar_lugares()
    {
        $trip = factory(Trip::class)->create();

        $truck = factory(TruckTract::class)->create();
        $truck->assignDevice(factory(Device::class)->create());
        $trip->setOrigin(factory(Place::class)->create(), now()->addDays(1),now()->addDays(2));
        $catedral = factory(Place::class)->create();
        $trip->setDestination($catedral, now()->addDays(4),now()->addDays(5));
        $trip->update(['truck_tract_id' => $truck->id]);

        $call = $this->postJson("api/v1/trips/$trip->id/give_exit", [
            "enable_automatic_updates" => true
        ]);
        $call->assertJsonValidationErrors([
            "place" => "The place $catedral->name can't connect to wialon."
        ]);

    }

    public function test_cerrar_viaje()
    {
        $trip = factory(Trip::class)->create();
        $trip->setDestination(
            factory(Place::class)->create(),
            now(),
            now(),
            now(),
            now()
        );

        $call = $this->deleteJson("/api/v1/trips/$trip->id/close_trip");
        $call->assertSuccessful();
    }

    public function test_no_puede_cerrar_viaje_si_no_esta_especificada_la_fecha_real_de_descarga()
    {
        $trip = factory(Trip::class)->create();
        $trip->setDestination(
            factory(Place::class)->create(),
            now(),
            now()
        );

        $call = $this->deleteJson("/api/v1/trips/$trip->id/close_trip");
        $call->assertJsonValidationErrors(
            'real_exiting'
        );

    }

}
