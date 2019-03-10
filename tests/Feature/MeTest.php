<?php

namespace Tests\Feature;

use App\Account;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeTest extends TestCase
{
    protected function setUp():void
{
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user, "api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);

    }

    public function test_usuario_loggeado_debe_poder_cambiar_su_contrasenha()
    {
        $user = factory(User::class)->create();
        $call = $this->actingAs($user)->json("POST", "/api/v1/me/change_password", [
            "password" => "321321321",
            "password_confirmation" => "321321321"
        ]);

        $call->assertStatus(200);
    }

    public function test_usuario_puede_acceder_a_sus_cuentas()
    {
        $account = factory(Account::class)->create();
        $account->addUser($this->user);
        $call = $this->getJson("/api/v1/me/accounts");
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "easyname",
                    "uuid"
                ]
            ]
        ]);

        $call->assertJsonFragment([
            "uuid" => $account->uuid
        ]);
    }
}
