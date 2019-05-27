<?php

namespace Tests\Feature;

use App\Account;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\License;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Punksolid\Wialon\Account as PunksolidAccount;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use App\Http\Middleware\RefreshPersonalAccessTokenMiddleware;
use App\Http\Middleware\IsUserPermittedInAccountMiddleware;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
    }

    public function test_acting_as()
    {
        $this->withoutMiddleware(RefreshPersonalAccessTokenMiddleware::class);
        $call = $this->actingAs($this->user, "api")->getJson("api/v1/me");
        $call->assertSee($this->user->email);
    }
    public function test_login_usuario()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $call = $this->json("POST", "/api/v1/login", [
            "email" => $user->email,
            "password" => "secret"
        ]);

        $call->assertJsonStructure([
            "access_token"
        ])
            ->assertStatus(200);
    }

    public function test_access_with_header_token()
    {
        $user = factory(User::class)->create();
        $token = $user->createToken('Token TEST')->accessToken;
        $call = $this->getJson("api/v1/me", ["Authorization" => "Bearer " . $token]);

        $call->assertStatus(200);
    }

    public function test_access_token_expira_a_los_15_minutos()
    {
        $this->markTestIncomplete("Falta agregar middleware que revisa expiracion");
        $this->withoutExceptionHandling();
  
        $user = factory(User::class)->create();
        // Personal
        Passport::personalAccessTokensExpireIn(now()->addMinutes(15));
  
        $token = $user->createToken('Token TEST')->accessToken;
        // dd($token, $token->accessToken);
        // $token = $token->accessToken;
        $travel_time = now()->addMinutes(25);
        Carbon::setTestNow($travel_time);
        $call = $this->getJson("api/v1/me", ["Authorization" => "Bearer " . $token]);

        $call->assertStatus(401);
    }

    public function test_check_innaccesible_endpoint_for_not_logged_users_not_authenticated()
    {
        $call = $this
            ->getJson("api/v1/me");

        $call->assertStatus(401); // no hizo login
    }

    /**
     * @throwException Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function test_user_cannot_access_to_other_accounts()
    {
        $this->withoutMiddleware(RefreshPersonalAccessTokenMiddleware::class);
        $this->withMiddleware(IsUserPermittedInAccountMiddleware::class);
        $user = factory(User::class)->create();
        $account = factory(Account::class)->create();
        
        $call  = $this
            ->actingAs($user, 'api')
            ->getJson('api/v1/dashboard', [
                'X-Tenant-Id' => $account->uuid
            ]);
        $call->assertStatus(403);
    }
}
