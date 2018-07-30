<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Testing\Fakes\MailFake;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Mockery\Mock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    public $user;
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
    }

    public function test_registrar_usuario()
    {
        $new_user = [
            "username" => $this->faker->userName,
            "password" => "secret",
            "name" => $this->faker->name,
            "lastname" => $this->faker->lastName,
            "email" => $this->faker->email
        ];

        $response = $this->actingAs($this->user)->json('POST', '/api/v1/users', $new_user);
        unset($new_user["password"]);
        $response
            ->assertJsonFragment($new_user)
            ->assertStatus(200);

        return $new_user;
    }

    public function test_login_usuario()
    {
        $user = factory(User::class)->create();
        $call = $this->json("POST", "/api/v1/login",[
            "email" => $user->email,
            "password" => "secret"
            ]);
        $call->assertJsonStructure([
            "access_token"
        ])
            ->assertStatus(200);
    }

    public function test_enviar_reestablecimiento_de_contrasenha()
    {
        $user = factory(User::class)->create();
//        Mail::fake();
        $call = $this->json("POST", "/api/v1/password/send_email", [
            "email" => $user->email
        ]);
        $this->markTestIncomplete("Assert Emails FAKE");

    }

    public function test_cambiar_contrasenha()
    {
        $user = factory(User::class)->create();
        $call = $this->actingAs($user)->json("POST", "/api/v1/password/change", [
            "password" => "321321321",
            "password_confirmation" => "321321321"
        ]);

        $call->assertStatus(200);
    }

    public function test_listar_usuarios()
    {
        $users = factory(User::class,2)->create();
        $response = $this->actingAs($this->user)->json('GET', '/api/v1/users');

        $response
            ->assertJsonFragment([
                "email" => $users->first()->email
            ])
            ->assertJsonFragment([
                "email" => $users->last()->email
            ])
            ->assertStatus(200);

    }
}
