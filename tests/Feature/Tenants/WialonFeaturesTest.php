<?php

namespace Tests\Feature;

use Tests\Tenants\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WialonFeaturesTest extends TestCase
{
    public function test_crear_geocerca()
    {
        $this->withoutExceptionHandling();
        $name = $this->faker->uuid;
        $lat = $this->faker->latitude;
        $lon = $this->faker->longitude;
        $radius = $this->faker->numberBetween(800, 1600);

        $call = $this->postJson("api/v1/wialon/geofences", [
            'name' => $name,
            'lat' => $lat,
            'lon' => $lon,
            'radius' => $radius
        ]);

        $call->assertJsonFragment([
            'name' => $name
        ]);
    }
}
