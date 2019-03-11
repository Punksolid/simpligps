<?php

namespace Tests\Unit;

use App\Device;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Punksolid\Wialon\Unit;
use Punksolid\Wialon\Wialon;
use Punksolid\Wialon\WialonError;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


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

        $units = $wialon_api->listUnits();

        $this->assertObjectHasAttribute("nm", $units->first(), "No cumplió con tener al menos una unidad y su nombre");

    }

    public function test_lectura_de_notificaciones_de_api_wialon()
    {
        $wialon_api = new Wialon();

        $notificaciones = $wialon_api->listNotifications();

        dump($notificaciones);
    }

    public function test_link_device_with_NOT_existing_wialon_unit()
    {
        $this->setWebsiteEnvironment();

        $device = factory(Device::class)->create();

        $this->assertFalse($device->linked());
    }

    public function test_device_linked_to_an_existing_wialon_unit()
    {
        $this->setWebsiteEnvironment();
        $device = factory(Device::class)->create();

        $unit = Unit::make($this->faker->name.Str::random(6));

        $device->linkUnit($unit);

        $this->assertTrue($device->linked());
    }

    public function test_import_units_to_devices()
    {
        $this->setWebsiteEnvironment();
        $wialon = new \App\Wialon("5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8");

        $devices = $wialon->import();

        $this->assertInstanceOf(Collection::class,$devices);
    }
}
