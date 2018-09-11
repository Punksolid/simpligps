<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_nueva_cuenta()
    {
        $account_details = [
          "easy_name" => $this->faker->word
        ];

        $call = $this->actingAs(factory(User::class)->create())->json("POST","api/v1/accounts",
            $account_details
        );

        $call->assertJson([
            "data" => [
                "easy_name" => $account_details["easy_name"]
            ]
        ]);
        $call->dump();
        $call->assertStatus(200);

    }
}
