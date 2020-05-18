<?php

namespace Tests\Feature;

use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\User;
use Tests\Tenants\TestCase;

class UsersTest extends TestCase
{
    var $user;


    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user, "api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);
        $this->withoutExceptionHandling();
        $this->withHeader("X-Tenant-Id", $this->account->uuid);
    }

    public function test_usuario_puede_registrar_otro_usuario()
    {
        $form = [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastname
        ];
        $call = $this->postJson('api/v1/users', $form  );
        $call->assertSuccessful();
    }

    public function test_listar_usuarios()
    {
        $users = factory(User::class, 2)->create();

        $user1 = $users->first();
        $user2 = $users->last();
        $this->account->addUser($user1);
        $this->account->addUser($user2);

        $call = $this->getJson('/api/v1/users');

        $call->assertJsonFragment([

                'id' => $user1->id,
                'email' => $user1->email

        ]);

        $call
            ->assertJsonFragment([
                "email" => $user1->email
            ])
            ->assertJsonFragment([
                "email" => $user2->email
            ])
            ->assertStatus(200);

    }

    public function test_buscar_usuario_por_email()
    {
        $this->withoutExceptionHandling();
        $user_to_search = factory(User::class)->create();
        $this->account->addUser($user_to_search);

        $call = $this->getJson("api/v1/users?email=$user_to_search->email");
        $call->assertJsonFragment([
            "email" => $user_to_search->email
        ]);

        $this->refreshApplication();
        $this->setUp(); // moraleja, procurar solo hacer una peticion por test

        $punksolid = User::first();
        $this->account->addUser($punksolid);
        $call2 = $this->getJson("api/v1/users?email=$punksolid->email");

        $call2->assertJsonFragment([
            "email" => $punksolid->email
        ]);
    }

    public function test_search_lastname()
    {
        $this->withoutExceptionHandling();
        $user_to_search = factory(User::class)->create();
        $this->account->addUser($user_to_search);

        $call = $this->getJson("api/v1/users?username={$user_to_search->lastname}");

        $call->assertJsonFragment([
            "lastname" => $user_to_search->lastname
        ]);

    }

    public function test_search_user_with_two_variables()
    {
        $this->withoutExceptionHandling();
        $user_to_search = factory(User::class)->create();
        $this->account->addUser($user_to_search);

        $call = $this->getJson("api/v1/users?name={$user_to_search['name']}&lastname={$user_to_search['lastname']}");

        $call->assertJsonFragment([
            "lastname" => $user_to_search['lastname']
        ]);
    }

    public function test_usuario_puede_eliminar_usuario_de_su_plataforma()
    {
        $user = factory(User::class)->create();
        $this->account->addUser($user);

        $call = $this->deleteJson("api/v1/users/$user->id");

        $call->assertSuccessful();

        $this->assertFalse($this->account->userExists($user));
    }
}
