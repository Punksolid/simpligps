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
        $wialon_api->call()
        $result = $wialon_api->login(config('services.wialon.token'));

        $json = json_decode($result,true);
        //print_r($json);

        if(!isset($json['error'])){

            echo $wialon_api->core_search_item('{"id":717359,"flags":0x1}');
            $wialon_api->logout();
        } else {

            echo WialonError::error($json['error']);
        }
    }
}
