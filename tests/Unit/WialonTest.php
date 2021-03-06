<?php

namespace Tests\Unit;

use App\Device;
use App\NotificationTrigger;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Punksolid\Wialon\Unit;
use Punksolid\Wialon\Wialon;
use Punksolid\Wialon\WialonError;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TruckTract;
use Punksolid\Wialon\Notification;

class WialonTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_wialon_response()
    {
        $wialon_api = new Wialon();

        $result = $wialon_api->login(config('services.wialon.token'));

        $json = json_decode($result);
        $sid = $json->eid;
        $this->assertNotNull($sid);
    }

    public function test_recoleccion_de_unidades_api_wialon()
    {
        $wialon_api = new Wialon();
        $units = Unit::all();
                
        $this->assertObjectHasAttribute("nm", $units->first(), "No cumplió con tener al menos una unidad y su nombre");
    }

    public function test_link_device_with_NOT_existing_wialon_unit()
    {
        $this->setWebsiteEnvironment();

        $device = factory(Device::class)->create();

        $this->assertFalse($device->linked());
    }

    public function test_device_linked_to_an_existing_wialon_unit(): void
    {
        $this->setWebsiteEnvironment();
        $device = factory(Device::class)->create();

        $unit = new Unit([
            'id' => 11111,
            'reference_data' => 11111
        ]);

        $device->linkUnit($unit);

        $this->assertTrue($device->linked());
    }

    public function test_import_units_to_devices()
    {
        $this->setWebsiteEnvironment();
        $wialon = new \App\Services\Wialon("5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8");

        $devices = $wialon->import();

        $this->assertInstanceOf(Collection::class, $devices);
    }

    public function test_importar_solo_devices_y_trucks_nuevos()
    {
        $this->markTestIncomplete("Hacer logica para solo los dispositivos restantes");
        $this->setWebsiteEnvironment();
        
        $wialon = new \App\Services\Wialon("5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8");
        $devices = $wialon->import();
        
        $this->assertInstanceOf(Collection::class, $devices);
    }

    public function test_import_notification_triggers()
    {
        $this->setWebsiteEnvironment();
        $wialon = new \App\Services\Wialon("5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8");

        $notifications = $wialon->importNotifications();

        $notifications_triggers = NotificationTrigger::all();
        $this->assertInstanceOf(Collection::class, $notifications);

        $this->assertNotNull($notifications_triggers->first());
    }
}
