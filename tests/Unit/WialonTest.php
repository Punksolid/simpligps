<?php

namespace Tests\Unit;

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
        //print_r($json);
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


}
