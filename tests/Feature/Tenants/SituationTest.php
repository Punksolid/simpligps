<?php

namespace Tests\Feature;

use App\Situation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class SituationTest extends TestCase
{
    public function test_registrar_nuevo_tipo_de_situacion()
    {
        $form = [
            'name' => $this->faker->name
        ];
        $call = $this->postJson('api/v1/situations', $form);
        $call->assertSuccessful();
        $call->assertJsonFragment($form);
        $call->assertJsonStructure([
            'data' => [
                'name'
            ]
        ]);
    }

    public function test_lista_todos_los_tipos_de_situacion()
    {
        $call = $this->getJson('api/v1/situations');

        $call->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name'
                ]
            ]
        ]);

    }

    public function test_edita_tipo_de_situacion()
    {
        $situation = factory(Situation::class)->create();
        $new_form = factory(Situation::class)->make()->toArray();

        $call = $this->putJson('api/v1/situations/'.$situation->id, $new_form);
        $call->assertSuccessful();
        $this->assertDatabaseHas('situations',$new_form,'tenant');
    }

    public function test_elimina_tipo_de_situacion()
    {
        $situation = factory(Situation::class)->create();

        $call = $this->deleteJson('api/v1/situations/'.$situation->id);

        $call->assertSuccessful();
        $this->assertSoftDeleted('situations', $situation->toArray(), 'tenant');
    }
}
