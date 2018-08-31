<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_registrar_un_nuevo_contacto()
    {
        $contact = [
            "name" => $this->faker->name,
            "company" => $this->faker->company,
            "phone" => $this->faker->phoneNumber,
            "email" => $this->faker->email,
            "address" => $this->faker->address
        ];

        $call = $this->actingAs(factory(User::class)->create())->json("POST","api/v1/contacts",$contact);

        $call->assertJsonFragment($contact);
        $call->assertStatus(201);

        return $call->getOriginalContent();
    }

    public function test_usuario_puede_ver_detalles_de_un_solo_contacto()
    {
        $contact = $this->test_registrar_un_nuevo_contacto();

        $call = $this->actingAs(factory(User::class)->create())->json("GET","api/v1/contacts/$contact->id");

        $call->assertJson([
            "data" => [
                "name" => $contact->name,
                "company" => $contact->company,
                "phone" => $contact->phone,
                "email" => $contact->email,
                "address" => $contact->address,

            ]
        ]);

    }

    public function test_listar_contactos_paginados()
    {
        $call = $this->actingAs(factory(User::class)->create())->json("GET", "api/v1/contacts");
        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "name",
                    "company",
                    "phone",
                    "address"
                ]
            ]
        ]);
        $call->assertStatus(200);
    }

    public function test_editar_registro_de_contacto()
    {
        $contact = $this->test_registrar_un_nuevo_contacto();
        $new_contact = [
            "name" => $this->faker->randomNumber(6) ,
            "company" => $this->faker->company,
            "phone" => $this->faker->phoneNumber,
            "address" => $this->faker->randomNumber(7)
        ];

        $call = $this->actingAs(factory(User::class)->create())->json("PUT","api/v1/contacts/$contact->id",$new_contact);

        $call->assertJsonFragment($new_contact);
        $call->assertStatus(200);
    }

    public function test_borrar_contacto()
    {
        $contact = $this->test_registrar_un_nuevo_contacto();
        $call = $this->actingAs(factory(User::class)->create())
            ->json("DELETE","api/v1/contacts/$contact->id");

        $this->assertDatabaseMissing("contacts",[
            "name" => $contact->name
        ]);
        $call->assertStatus(200);

    }
}
