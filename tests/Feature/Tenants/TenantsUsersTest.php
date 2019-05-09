<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class TenantsUsersTest extends TestCase
{
    public function test_registrar_usuario()
    {
        $new_user = [
            "password" => "secret",
            "name" => $this->faker->name,
            "lastname" => $this->faker->lastName,
            "email" => $this->faker->email
        ];

        $response = $this->postJson('/api/v1/users', $new_user);
        unset($new_user["password"]);
        $response
            ->assertJsonFragment($new_user)
            ->assertStatus(200);

        return $new_user;
    }
}
