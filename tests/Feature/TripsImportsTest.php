<?php

namespace Tests\Feature;

use App\Client;
use App\Place;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class TripsImportsTest extends TestCase
{
    public function test_puede_importar_plan_de_viaje_con_datos_minimos()
    {
//        $this->withoutExceptionHandling();
        $trip = [
            "client_id" => 1,
            "origin_id" => 1,
            "destination_id" => 14,
            "georoute_ref" => "",
            "mon_type" => '',
            "scheduled_load" => "2019-12-01 08:08:00",
            "scheduled_departure" => "2019-12-01 09:09:00",
            "scheduled_arrival" => "2019-12-02 10:10:00",
            "scheduled_unload" => "2019-12-11 11:11:00",
        ];
                // storage/framework/testing/TripsListTest.xlsx

        $form = [
          'trips' => new UploadedFile(
              storage_path().'/framework/testing/TripsListTest.xlsx',
              'TripsListTest.xlsx',
          'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
          )
        ];
        $call = $this->postJson('api/v1/imports', $form);
        $call->assertSuccessful();
        $this->assertDatabaseHas('trips',[
            "client_id" => 1,
        ],'tenant');

        // Check origin
        $this->assertDatabaseHas('places_trips',[
            "place_id" => $trip['origin_id'],
            "at_time" => $trip['scheduled_load'],
            "exiting" => $trip['scheduled_departure'],

        ],'tenant');

        // Assert Destination
        $this->assertDatabaseHas('places_trips',[
            "place_id" => $trip['destination_id'],
            "at_time" => $trip['scheduled_arrival'],
            "exiting" => $trip['scheduled_unload'],
//            'type' => 'destination'
        ],'tenant');

    }

    public function test_lanza_errores_cuando_cualquier_fila_tiene_error_y_no_salva_ninguna_otra_fila()
    {
//        $this->withoutExceptionHandling();

        $form = [
            'trips' => new UploadedFile(
                storage_path().'/framework/testing/TripsListTestErrorLine3.xlsx',
                'TripsListTestErrorLine3.xlsx',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            )
        ];
        $call = $this->postJson('api/v1/imports', $form);

        $call->assertJsonValidationErrors('0');
    }
}
