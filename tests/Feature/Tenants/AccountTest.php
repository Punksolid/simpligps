<?php

namespace Tests\Feature\Tenants;

use Tests\Tenants\TestCase;

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
