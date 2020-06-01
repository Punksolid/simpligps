<?php

namespace Tests\Feature;

use App\Device;
use App\Services\Traccar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Mock;
use Spatie\Geocoder\Geocoder;
use Tests\Tenants\TestCase;

class AlexaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWelcomeMessage(): void
    {
        $response = $this->postJson('api/v1/alexa/01b421a3055f4e9bab1d5a3e186a6149', [
            'request' => [
                'type' => 'LaunchRequest'
            ]
        ]);
        $response->assertJsonStructure([
            'response' => [
                'outputSpeech' => [
                    'type',
                    'text'
                ]
            ]
        ]);
    }

    public function testDeviceFoundWithLocation(): void
    {
        $this->withoutExceptionHandling();

        $device = factory(Device::class)->create([
            'wialon_id' => 321654987
        ]);
        $geocoder = \Mockery::mock(Geocoder::class);
        $geocoder->shouldReceive('setApiKey')->andReturnNull();
        $geocoder->shouldReceive('getAddressForCoordinates')
            ->andReturn([
                'formatted_address' => 'Avenida Siempreviva 742'
            ]);
        $traccar = \Mockery::mock(Traccar::class);
        $traccar->shouldReceive('getPosition')
            ->andReturn([
                (object)[
                    'latitude' => 20,
                    'longitude' => 40
                ]
            ]);
        $traccar->shouldReceive('isConfigured')->andReturnTrue();

        $this->app->instance(Geocoder::class,$geocoder);
        $this->app->instance(Traccar::class, $traccar);
        $response = $this->postJson('api/v1/alexa/01b421a3055f4e9bab1d5a3e186a6149', [
            'request' => [
                'intent' => [
                    'slots' => [
                        'gps_device' => [
                            'value' => $device->name
                        ]
                    ]
                ]
            ]
        ]);

        $response->assertJsonStructure([
            'response' => [
                'outputSpeech' => [
                    'type',
                    'text'
                ]
            ]
        ]);

        $response->assertSeeText(
            "Avenida Siempreviva 742"
        );
    }
}
