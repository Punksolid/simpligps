<?php

namespace Tests\Feature;

use App\Account;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\License;
use App\User;
use Carbon\Carbon;
use Tests\Tenants\TestCase;

class LoginInTenantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withHeader("X-Tenant-Id", $this->account->uuid);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function test_cuenta_no_puede_tener_mas_de_2_sesiones_activas()
    {
        $this->markTestIncomplete('TODO! BAJA PRIORIDAD');
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
        
        $call1->assertSuccessful();
        $call2->assertSuccessful();
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
        $call->assertStatus(403); // code for logged but not authorized
        \Cache::flush();
    }

    public function test_usuario_selecciona_una_cuenta()
    {

        $this->account->addUser($this->user);
        factory(\Spatie\Activitylog\Models\Activity::class)->create([
            'description' => "what",
            'log_name' => 'access_log',
            'causer_id' => $this->user->id,
            'causer_type' => 'App\User'
         ]);
        // dd($this->account->uuid);
        $call = $this->getJson("api/v1/account/access_logs", [
            "X-Tenant-Id" => $this->account->uuid
        ]);
        $call->assertSuccessful();
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "id",
                    "description",
                    "message"
                ]
            ]
        ]);
        // $call->dump();
    }
}
