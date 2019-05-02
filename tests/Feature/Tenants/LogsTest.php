<?php

namespace Tests\Feature;

use App\Device;
use App\Log;
use App\Trip;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class LogsTest extends TestCase
{
   public function test_registrar_una_linea_para_trips_en_logs()
   {
       $trip = factory(Trip::class)->create();
       $log =
            [
            'unit' =>"PTS003",
            'timestamp' =>"2019-05-02 01:58:08",
            'location' =>"Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
            'last_location' =>"Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
            'locator_link' =>"http://sh-loc.com/W0Ef",
            'smallest_geofence_inside' =>"RutaEnBici",
            'all_geofences_inside' =>"RutaEnBici",
            'UNIT_GROUP' =>"%UNIT_GROUP%",
            'SPEED' =>"0 km/h",
            'POS_TIME' =>"2019-05-02 01:58:06",
            'MSG_TIME' =>"2019-05-02 01:58:06",
            'DRIVER' =>"%DRIVER%",
            'DRIVER_PHONE' =>"%DRIVER_PHONE%",
            'TRAILER' =>"%TRAILER%",
            'SENSOR' =>"Bateria =>84.00 %",
            'ENGINE_HOURS' =>"0:00:00",
            'MILEAGE' =>"0.00 km",
            'LAT' =>"N 24° 47.5082'",
            'LON' =>"W 107° 24.2671'",
            'LATD' =>"24.791803",
            'LOND' =>"-107.404452",
            'GOOGLE_LINK' =>"http://maps.google.com/?q=24.791803,-107.404452",
            'CUSTOM_FIELD' =>"%CUSTOM_FIELD(*)%",
            'UNIT_ID' =>"17471332",
            'MSG_TIME_INT' =>"1556783886",
            'NOTIFICATION' =>"Copy of leaving.49",
            'X-Tenant-Id' =>"f1b45786af864c1f813187bb0b18f540",
            'trip_id' =>"49",
            'device' =>"6"
            ];


       $trip->logs()->create(['data' => $log]);

       $log = $trip->logs()->first();
       $this->assertEquals("PTS003", $log->data['unit']);
   }

   public function test_listar_logs_de_un_viaje()
   {
       $this->withoutExceptionHandling();
       $trip = factory(Trip::class)->create();
       $log =
           [
               'unit' =>"PTS003",
               'timestamp' =>"2019-05-02 01:58:08",
               'location' =>"Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
               'last_location' =>"Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
               'locator_link' =>"http://sh-loc.com/W0Ef",
               'smallest_geofence_inside' =>"RutaEnBici",
               'all_geofences_inside' =>"RutaEnBici",
               'UNIT_GROUP' =>"%UNIT_GROUP%",
               'SPEED' =>"0 km/h",
               'POS_TIME' =>"2019-05-02 01:58:06",
               'MSG_TIME' =>"2019-05-02 01:58:06",
               'DRIVER' =>"%DRIVER%",
               'DRIVER_PHONE' =>"%DRIVER_PHONE%",
               'TRAILER' =>"%TRAILER%",
               'SENSOR' =>"Bateria =>84.00 %",
               'ENGINE_HOURS' =>"0:00:00",
               'MILEAGE' =>"0.00 km",
               'LAT' =>"N 24° 47.5082'",
               'LON' =>"W 107° 24.2671'",
               'LATD' =>"24.791803",
               'LOND' =>"-107.404452",
               'GOOGLE_LINK' =>"http://maps.google.com/?q=24.791803,-107.404452",
               'CUSTOM_FIELD' =>"%CUSTOM_FIELD(*)%",
               'UNIT_ID' =>"17471332",
               'MSG_TIME_INT' =>"1556783886",
               'NOTIFICATION' =>"Copy of leaving.49",
               'X-Tenant-Id' =>"f1b45786af864c1f813187bb0b18f540",
               'trip_id' =>"49",
               'device' =>"6"
           ];
       $trip->logs()->create(['data' => $log]);

       $call = $this->getJson("api/v1/trips/$trip->id/logs");
       $call->assertSuccessful();
       $call->assertJsonFragment([
           "level" => "generic"
       ]);
       $call->assertJsonFragment([
           "unit" => "PTS003"
       ]);
   }

   public function test_listar_logs_de_un_dispositivo()
   {
       $this->withoutExceptionHandling();

       $device = factory(Device::class)->create();
       $log =
           [
               'unit' =>"PTS003",
               'timestamp' =>"2019-05-02 01:58:08",
               'location' =>"Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
               'last_location' =>"Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
               'locator_link' =>"http://sh-loc.com/W0Ef",
               'smallest_geofence_inside' =>"RutaEnBici",
               'all_geofences_inside' =>"RutaEnBici",
               'UNIT_GROUP' =>"%UNIT_GROUP%",
               'SPEED' =>"0 km/h",
               'POS_TIME' =>"2019-05-02 01:58:06",
               'MSG_TIME' =>"2019-05-02 01:58:06",
               'DRIVER' =>"%DRIVER%",
               'DRIVER_PHONE' =>"%DRIVER_PHONE%",
               'TRAILER' =>"%TRAILER%",
               'SENSOR' =>"Bateria =>84.00 %",
               'ENGINE_HOURS' =>"0:00:00",
               'MILEAGE' =>"0.00 km",
               'LAT' =>"N 24° 47.5082'",
               'LON' =>"W 107° 24.2671'",
               'LATD' =>"24.791803",
               'LOND' =>"-107.404452",
               'GOOGLE_LINK' =>"http://maps.google.com/?q=24.791803,-107.404452",
               'CUSTOM_FIELD' =>"%CUSTOM_FIELD(*)%",
               'UNIT_ID' =>"17471332",
               'MSG_TIME_INT' =>"1556783886",
               'NOTIFICATION' =>"Copy of leaving.49",
               'X-Tenant-Id' =>"f1b45786af864c1f813187bb0b18f540",
               'trip_id' =>"49",
               'device' =>"6"
           ];
       $device->logs()->create(['data' => $log]);

       $call = $this->getJson("api/v1/devices/$device->id/logs");
       $call->assertSuccessful();
       $call->assertJsonFragment([
           "level" => "generic"
       ]);
       $call->assertJsonFragment([
           "unit" => "PTS003"
       ]);
   }
}
