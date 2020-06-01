<?php

namespace Tests\Unit;

use App\Device;
use App\Jobs\Traccar\ImportDevices;
use App\Jobs\Traccar\ImportDevices as TraccarImportDevices;
use App\Services\Traccar;
use Javleds\Traccar\Facades\Client;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Tests\Tenants\TestCase;

class TraccarTest extends TestCase
{

    public function testAllTraccarDevices(): void
    {
        $traccar = new TraccarImportDevices();
        $devices = $traccar->allTraccarDevices();
        $device = $devices->first()->toArray();

        $this->assertArrayHasKey('id', $device);
        $this->assertArrayHasKey('uniqueId', $device);
    }

    public function testImport(): void
    {
        $name = $this->faker->name;
        Client::shouldReceive('get')
            ->andReturn([(object)[
                'name' => $name,
                'id' => $this->faker->numberBetween(111,9999)
            ]]);

        $traccar_import = new ImportDevices();
        $traccar_import->handle();

        $this->assertDatabaseHas('devices',[
            'name' => $name
        ],'tenant');
    }

    public function testCanSeeLocalizationOfDevice(): void
    {
        $traccar = $this->mock(Traccar::class)->makePartial();
        $traccar->shouldReceive('getPosition')
            ->andReturn([
                (object)[
                    'latitude' => 20,
                    'longitude' => 40
                ]
            ]);
        $this->app->instance(Traccar::class,$traccar);

        /** @var Device $device */
        $device = factory(Device::class)->create(['wialon_id' => 1234]);

        $this->assertNotNull($device->getLocation()['lat']);
        $this->assertNotNull($device->getLocation()['lon']);
    }
}
