<?php

namespace Tests\Feature;

use Tests\Tenants\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    public function test_usuario_puede_ver_notificationes_de_la_cuenta_paginada()
    {

        $call = $this->getJson("api/v1/account/notifications");

        $call->assertJsonStructure([
            "data",
            "meta",
            "links"
        ]);
    }
}
