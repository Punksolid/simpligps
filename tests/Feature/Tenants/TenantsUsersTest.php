<?php

namespace Tests\Feature;

use Tests\Tenants\TestCase;

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
