<?php

namespace Tests\Feature;

use App\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class ClientsTest extends TestCase
{

    public function test_se_puede_registrar_un_cliente()
    {
        $this->withoutExceptionHandling();
        $form = [
            'name' => $this->faker->name,
            'company' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'contact' => 'esto para que?',
            'email' => $this->faker->email,
            'address' => $this->faker->address
        ];

        $call = $this->postJson('api/v1/clients', $form);

        $call->assertSuccessful();

        $this->assertDatabaseHas('clients', $form, 'tenant');
    }


    public function test_editar_cliente()
    {
//        $this->markTestIncomplete();

        $client = factory(Client::class)->create();
        $form = [
            'name' => $this->faker->name,
            'company' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'contact' => 'esto para que?',
            'email' => $this->faker->email,
            'address' => $this->faker->address
        ];

        $call = $this->putJson('api/v1/clients/' . $client->id, $form);

        $call->assertSuccessful();
//        $call->assertJsonFragment($form);


    }

    public function test_ver_detalle_de_cliente()
    {
        $client = factory(Client::class)->create();

        $call = $this->getJson('api/v1/clients/' . $client->id);

        $call->assertSuccessful();
    }

    public function test_puede_listar_clientes()
    {
        $call = $this->getJson('api/v1/clients');

        $call->assertSuccessful();
    }

    public function test_puede_eliminar_clientes()
    {
        $client = factory(Client::class)->create();

        $call = $this->deleteJson("api/v1/clients/$client->id");

        $call->assertSuccessful();
        $this->assertDatabaseHas('clients', [
            "name" => $client->name
        ], 'tenant');
    }
}
