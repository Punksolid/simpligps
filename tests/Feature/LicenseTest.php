<?php

namespace Tests\Feature;

use App\Account;
use App\License;
use App\Sysadmin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LicenseTest extends TestCase
{

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->admin = factory(Sysadmin::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_licencia()
    {
        $licencia = [
            "name" => "personalizado",
            "description" => "textotextotext",
            "lapse" => random_int(10, 50),
            "modules" => "monitoring",
            "units" => random_int(10, 500),
            "number_active_sessions" => random_int(1, 50)
        ];

        $call = $this->actingAs($this->admin)->json("POST", "api/sysadminv1/licenses", $licencia);


        $call->dump()->assertJsonStructure([
            "data" => [
                "lapse",
                "modules" => "*",
                "units",
                "number_active_sessions"
            ]
        ]);
        $call->assertStatus(201);
    }

    public function test_asignar_licencia_a_cuenta()
    {
        $license = factory(License::class)->create();
        $account = factory(Account::class)->create();

        $call = $this->actingAs($this->admin)->json("POST", "api/sysadminv1/licenses/$license->id/assign_to_account",[
            "account_id" => $account->id
        ]);

        $call->assertSuccessful();

    }
}
