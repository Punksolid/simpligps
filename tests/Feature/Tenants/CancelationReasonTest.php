<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;
use App\Http\Middleware\RefreshPersonalAccessTokenMiddleware;
use App\CancelationReason;

class CancelationReasonTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
        $this->withoutMiddleware(RefreshPersonalAccessTokenMiddleware::class);
    }

    public function test_usuario_puede_registrar_una_nueva_razon_de_cancelacion()
    {
        $form = [
            "name" => $this->faker->name
        ];

        $call = $this->postJson('api/v1/cancelation_reasons', $form);
        $call->assertJson([
            "data" => $form
        ]);
        $call->assertSuccessful();
    }

    public function test_usuario_puede_ver_listado_de_razones_de_cancelacion()
    {
        $call = $this->getJson("api/v1/cancelation_reasons");
        $call->assertSuccessful();
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "name"
                ]
            ]
        ]);

    }

    public function test_usuario_debe_poder_editar_razones_de_cancelacion()
    {
        $reason = factory(CancelationReason::class)->create();
        $new = [
            "name" => $this->faker->name
        ]; 
        $call = $this->putJson("api/v1/cancelation_reasons/$reason->id", $new);
        $call->assertSuccessful();
        $call->assertJsonFragment([
            "name" => $new['name']
        ]);
    }

    public function test_usuario_puede_eliminar_razones_de_cancelacion()
    {
        $reason = factory(CancelationReason::class)->create();
        $call = $this->deleteJson("api/v1/cancelation_reasons/{$reason->id}");

        $call->assertSuccessful();
        
    }
}
