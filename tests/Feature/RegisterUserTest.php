<?php

namespace Tests\Feature;

use App\Mail\InviteMail;
use App\Notifications\PasswordResetRequest;
use App\PasswordReset;
use App\Sysadmin;
use App\User;
use Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
//    use DatabaseTransactions;


    protected function setUp():void
{
        parent::setUp(); // TODO: Change the autogenerated stub

//        $this->be(factory(User::class)->create(), "api");
    }



    public function test_enviar_reestablecimiento_de_contrasenha()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        \Notification::fake();
        Mail::fake();
        $call = $this->json("POST", "/api/v1/password/send_email", [
            "email" => $user->email
        ]);

        \Notification::assertSentTo(
            [$user], PasswordResetRequest::class
        );


    }

    public function test_cambiar_contrasenha_despues_de_recibir_email()
    {
        /**
         * El token que se tiene que enviar es un hash no el token que se encuentra en la base de datos
         * El token es enviado en el email, hace falta buscar una manera de generar un token en base de
         * un password reset
         */
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'password' => bcrypt('87654321')
        ]);
        \Notification::fake();
        $call = $this->postJson("/api/v1/password/send_email", [
            "email" => $user->email
        ]);
        $token = '';
        \Notification::assertSentTo(
            $user,
            PasswordResetRequest::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;

                return true;
            });

        $call = $this->postJson("/api/v1/password/change/", [
            "email" => $user->email,
            "password" => "87654321",
            "password_confirmation" => "87654321",
            "token" => $token
        ]);



        $call->assertStatus(200);
    }

    /**
     * Verificar que el email es enviado al crear una cuenta nueva con un email inexistente
     */
    public function test_create_user_invitation_and_send()
    {
        $this->withoutExceptionHandling();

        $this->be(factory(Sysadmin::class)->create(), 'sysadmin-api');

        $form = [
            'easyname' => $this->faker->firstName.\Illuminate\Support\Str::random(10),
            'email' => $this->faker->safeEmail
        ];

        Mail::fake();

        $call = $this->postJson('api/sysadmin/v1/accounts', $form);

        $call->assertSuccessful();
        Mail::assertSent(InviteMail::class, function ($mailable) use ($form) {

            return ($mailable->hasTo($form['email']) &&
            Hash::check($mailable->token, PasswordReset::whereEmail($form['email'])->first()->token)
            );
        });

        return $form;
    }

    public function test_continue_user_registration()
    {
        $this->withoutExceptionHandling();
        $this->be = null;
        $user = factory(User::class)->create();
        $broker = Password::broker();
        $hash = $broker->createToken($user);
        $form = [
            'email' => $user->email,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'hash' => $hash
        ];

        $call = $this->postJson('api/v1/continue_registration', $form);

        $call->assertSuccessful();

        $call->assertJsonFragment([
            'message' => 'You can now login.'
        ]);
    }
}
