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

        $call = $this->postJson( "api/sysadminv1/login", [
            "email" => "sysadmin_test@gmail.com",
            "password" => "443rancid."
        ]);
        $call->assertSuccessful();
        $call2 = $this->postJson( "api/sysadminv1/login", [
            "email" => $admin->email,
            "password" => "secret"
        ]);
        $call2->assertSuccessful();
        $call->assertJsonStructure([
            "data" => [
                "access_token"
            ]
        ]);
    }
}
