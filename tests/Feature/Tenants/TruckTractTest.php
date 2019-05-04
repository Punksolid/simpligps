<?php

namespace Tests\Feature;

use App\TruckTract;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class TruckTractTest extends TestCase
{
    public function test_listar_tracto_camiones()
    {
        factory(TruckTract::class)->create();

        $call = $this->getJson('api/v1/trucks');

        $call->assertJsonStructure([
            'data' => [
                "*" => [
                    'id',
                    'plate',
                    'model',
                    'internal_number',
                    'brand',
                    'gps',
                    'carrier_id',
                    'color',
                    'device_id'
                ]
            ]
        ]);
    }

    public function test_crear_tracto()
    {
        $this->withoutExceptionHandling();
        $truck = factory(TruckTract::class)->make();

        $call = $this->postJson('api/v1/trucks', $truck->toArray());

        $call->assertJsonFragment($truck->toArray());
    }


    public function test_ver_detalles_de_tracto()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->getJson("api/v1/trucks/$truck->id");

        $call->assertJsonFragment($truck->toArray());
    }

    public function test_actualizar_detalles_de_tracto()
    {

        $truck = factory(TruckTract::class)->create();
        $new = factory(TruckTract::class)->make();
        $call = $this->putJson("api/v1/trucks/$truck->id", $new->toArray());

        $call->assertJsonFragment($new->toArray());
    }

    public function test_eliminar_tracto()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->deleteJson("api/v1/trucks/$truck->id");

        $call->assertSuccessful();
    }

    public function test_puede_buscar_tracto_por_nombre()
    {
        $truck = factory(TruckTract::class)->create();
        $call = $this->getJson("api/v1/trucks/search?plate=$truck->plate");

        $call->assertSuccessful();
        $call->assertJsonFragment([
            'plate' => $truck->plate
        ]);
    }
}
