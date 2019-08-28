<?php

namespace Tests\Feature;

use App\Trip;
use App\User;
use Tests\Tenants\TestCase;

class TagsTest extends TestCase
{
    public function test_list_all_tags()
    {
        $trip = factory(Trip::class)->create([
            'tags' => ['one', 'two']
        ]);

        $call = $this->getJson('api/v1/tags');
        $call->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'slug'
                ]
            ]
        ]);
        $call->assertSee('one');
        $call->assertSee('two');
    }

    public function test_trips_list_with_tags()
    {
        $tag = $this->faker->word;
        $trip = factory(Trip::class)->create([
            'tags' => [$tag, 'two']
        ]);
        $call = $this->getJson('api/v1/trips');

        $call->assertSee($tag);

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
        $trip = factory(Trip::class)->create();

        $etiqueta = $this->faker->word;
        $call = $this->postJson( "/api/v1/trips/{$trip->id}/tags", [
            "tags" => [
                $etiqueta
            ]
        ]);

        $call->assertSee($etiqueta);
        $call->assertStatus(200);
    }

    public function test_puede_sincronizar_etiquetas()
    {
        $trip = factory(Trip::class)->create([
            'tags' => [
                'hello'
            ]
        ]);

        $call = $this->postJson( "/api/v1/trips/{$trip->id}/tags", [
            "tags" => []
        ]);
        $call->assertSuccessful();
        $this->assertEquals(0,$trip->fresh()->tags->count());

    }
}
