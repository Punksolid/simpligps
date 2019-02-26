<?php

namespace Tests\Feature;

use App\Sysadmin;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SysadminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_sysadmin_puede_hacer_login()
    {
        $this->withoutExceptionHandling();
        $admin = factory(Sysadmin::class)->create();

        $call = $this->postJson( "api/sysadmin/v1/login", [
            "email" => "punksolid@gmail.com",
            "password" => "443rancid."
        ]);
        $call->assertSuccessful();
        $call2 = $this->postJson( "api/sysadmin/v1/login", [
            "email" => $admin->email,
            "password" => "secret"
        ]);
        $call->assertJsonStructure([
            "data" => [
                "access_token"
            ]
        ]);
        $call2->assertSuccessful();
    }
}
