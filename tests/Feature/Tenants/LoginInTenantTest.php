<?php

namespace Tests\Feature;

use App\Account;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\License;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class LoginInTenantTest extends TestCase
{
    /**
     */
    public function test_cuenta_no_puede_tener_mas_de_2_sesiones_activas()
    {
        $this->withoutExceptionHandling();
        $this->withMiddleware(LimitSimoultaneousAccess::class);
        $user1 = factory(User::class)->create(["name" => "pedro"]);
        $user2 = factory(User::class)->create(["name" => "juan"]);
        $user3 = factory(User::class)->create(["name" => "luis"]);


        $account = factory(Account::class)->create();
        $account->addLicense(factory(License::class)->create([
            "number_active_sessions" => 2
        ]));

        $account->addUser($user1);
        $account->addUser($user2);
        $account->addUser($user3);

        $call1 = $this->actingAs($user1, "api")->getJson("api/v1/devices");

        $call2 = $this->actingAs($user2, "api")->getJson("api/v1/devices");

        $call3 = $this->actingAs($user3, "api")->getJson("api/v1/devices");

        $this->markTestIncomplete("falta agregar la verificacion en multitenant");

    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function test_denegar_acceso_sin_licencia_activa()
    {
        $this->withMiddleware(LimitExpiredLicenseAccess::class);
        $this->withoutExceptionHandling();

        $license = factory(License::class)->create();

        $this->account->addLicense($license, ["expires_at" => Carbon::yesterday()->toDateTimeString()]);
        $this->user->attachAccount($this->account);

        $call = $this->getJson("api/v1/devices");
        dump($this->user->toArray());
        dump($this->account->id);
        \Cache::flush();
    }
}