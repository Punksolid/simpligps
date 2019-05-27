<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;
use App\Trip;
use App\Device;

class TripsNotificationsTest extends TestCase
{
    public function test_usuario_puede_activar_alerta_de_detalle_en_viaje()
    {
        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->create();
        $device = factory(Device::class)->create();
        $payload = [
            "unit" => "PTS003",
            "timestamp" => "2019-05-24 18:27:00",
            "location" => "Avenida General Aquiles Serdán 131, Miguel Alemán, Culiacán, Sinaloa 80200, Mexico",
            "last_location" => "Avenida General Aquiles Serdán 3, Culiacán Centro, Culiacán, Sinaloa 80000, Mexico",
            "locator_link" => "http://sh-loc.com/jesq",
            "smallest_geofence_inside" => "%ZONE_MIN%",
            "all_geofences_inside" => "%ZONES_ALL%",
            "UNIT_GROUP" => "%UNIT_GROUP%",
            "SPEED" => "0 km/h",
            "POS_TIME" => "2019-05-24 18:24:54",
            "MSG_TIME" => "2019-05-24 18:24:54",
            "DRIVER" => "%DRIVER%",
            "DRIVER_PHONE" => "%DRIVER_PHONE%",
            "TRAILER" => "%TRAILER%",
            "SENSOR" => "Bateria: 73.00 %",
            "ENGINE_HOURS" => "0:00:00",
            "MILEAGE" => "0.00 km",
            "LAT" => "N 24° 48.1070'",
            "LON" => "W 107° 23.3399'",
            "LATD" => "24.801783",
            "LOND" => "-107.388998",
            "GOOGLE_LINK" => "http://maps.google.com/?q=24.801783,-107.388998",
            "CUSTOM_FIELD" => "%CUSTOM_FIELD(*)%",
            "UNIT_ID" => "17471332",
            "MSG_TIME_INT" => "1558711494",
            "NOTIFICATION" => "NombreNotification",
            "X-Tenant-Id" => "b51db8d2-a890-4629-9350-502fe18739c9",
            "notification_id" => "5",
            "trip_id" => $trip->id,
            "device" => $device->id
        ]; 

        $call = $this->postJson("api/v1/{$this->account->uuid}/alert/trips/$trip->id", [
            $payload
        ]);
        
        $call->assertSuccessful();
    }
}
