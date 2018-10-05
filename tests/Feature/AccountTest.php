<?php

namespace Tests\Feature;

use App\Account;
use App\License;
use App\Sysadmin;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{

    private $sysadmin;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->sysadmin = factory(Sysadmin::class)->create();
        $this->actingAs($this->sysadmin,"sysadmin-api");
        $this->withoutExceptionHandling();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_nueva_cuenta()
    {
        $account_details = [
            "easyname" => $this->faker->unique()->word.$this->faker->unique()->word
        ];

        $call = $this->postJson( "api/sysadminv1/accounts",
            $account_details
        );

        $call->assertJson([
            "data" => [
                "easyname" => $account_details["easyname"]
            ]
        ]);

        $call->assertStatus(201);

    }

    public function test_sysadmin_puede_ver_listado_de_cuentas()
    {


        $call = $this->actingAs($this->sysadmin)->call("GET", 'api/sysadminv1/accounts');

        $call
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        "id",
                        "easyname"
                    ]
                ],
                "links",
                "meta"
            ]);
    }

    public function test_eliminar_cuenta()
    {
        $sysadmin = factory(Sysadmin::class)->create();
        $account_details = [
            "easyname" => $this->faker->unique()->word.$this->faker->unique()->word
        ];
        $call = $this->actingAs($this->sysadmin)->json("POST", "api/sysadminv1/accounts",
            $account_details
        );

        $id = $call->getOriginalContent()["id"];
        $uuid = $call->getOriginalContent()["uuid"];

        $call2 = $this->actingAs($sysadmin)->json("DELETE", "api/sysadminv1/accounts/{$id}");


        $this->assertDatabaseMissing("accounts", [
            "uuid" => $uuid
        ]);

    }

    /*
     * Sysadmin debe poder agregar datos fiscales a cuentas,
     * razon social,
     * contactos,
     * domicilio,
     *  telefonos,
     * tipo de empresa
     */
    public function test_sysadmin_puede_agregar_datos_fiscales_de_cuentas()
    {
        $fiscal_data = [
            "business_name" => $this->faker->company,
            "contact" => $this->faker->name,
            "address" => $this->faker->address,
            "phone" => $this->faker->phoneNumber,
            "business_type" => $this->faker->word
        ];
        $fake_account = factory(Account::class)->create();

        $call = $this->actingAs($this->sysadmin)->json(
            "PUT",
            "api/sysadminv1/accounts/{$fake_account->id}/fiscal",
            $fiscal_data
        );

        $call->assertSuccessful();

    }

    public function test_dashboard_account_counts()
    {
        $call = $this->actingAs($this->sysadmin)->json("GET", "api/sysadminv1/accounts/active_accounts");

        $call->assertStatus(200);

        $call->assertJsonStructure([
            "data"
        ]);
    }

    public function test_ver_cuentas_activas()
    {
        $active_account = factory(Account::class)->create();
        $license = factory(License::class)->create(["lapse" => 30]);
        $active_account->addLicense($license);

        $some_account = factory(Account::class)->create();

        $call = $this->actingAs($this->sysadmin)->json("GET", "api/sysadminv1/accounts/active_accounts");


        $call->assertJsonFragment([
            "id" => $active_account->id,
            "easyname" => $active_account->easyname,
            "uuid" => $active_account->uuid

        ]);
    }

    public function test_ver_cuentas_proximas_a_expirar_dentro_de_7_dias()
    {
        $near_to_expire = factory(Account::class)->create();
        $license = factory(License::class)->create(["lapse" => 3]);
        $near_to_expire->addLicense($license);

        $active_account = factory(Account::class)->create();
        $license = factory(License::class)->create(["lapse" => 30]);
        $active_account->addLicense($license);

        $call = $this->actingAs($this->sysadmin)->json("GET", "api/sysadminv1/accounts/near_to_expire");

        $call->assertJsonFragment([
            "id" => $near_to_expire->id,
            "easyname" => $near_to_expire->easyname,
            "uuid" => $near_to_expire->uuid

        ]);
        $call->assertDontSee($active_account->uuid);
    }

}
