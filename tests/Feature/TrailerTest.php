<?php

namespace Tests\Feature;

use App\TrailerBox;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class TrailerTest extends TestCase
{
    public function test_listar_todas_las_cajas()
    {
        factory(TrailerBox::class)->create();

        $call = $this->getJson('api/v1/trailers');

        $call->assertJsonStructure([
            'data' => [
                "*" => [
                    'id',
                    'carrier_name',
                    'plate',
                    'internal_number',
                    'gps',
                    'carrier_id'
                ]
            ]
        ]);

    }
    public function test_registrar_caja()
    {
        $this->withoutExceptionHandling();
        $trailer = factory(TrailerBox::class)->make();

        $call = $this->postJson('api/v1/trailers', $trailer->toArray());

        $call->assertJsonFragment($trailer->toArray());
    }

    public function test_editar_caja()
    {
        $trailer = factory(TrailerBox::class)->create();
        $new_trailer = factory(TrailerBox::class)->make();

        $call = $this->postJson('api/v1/trailers', $new_trailer->toArray());

        $call->assertJsonFragment($new_trailer->toArray());
    }

    public function test_eliminar_caja()
    {
        $trailer = factory(TrailerBox::class)->create();

        $call = $this->deleteJson("api/v1/trailers/$trailer->id");

        $call->assertSuccessful();
        $this->assertSoftDeleted('trailer_boxes',[
            'plate' => $trailer->plate
        ],'tenant');
    }
}
