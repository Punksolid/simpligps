<?php

namespace Tests\Feature;

use App\Permission;
use App\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_listar_todos_los_permisos()
    {
        $call = $this->actingAs(factory(User::class)->create())->json("GET", "/api/v1/permissions");
        $call->assertJsonFragment([
            "name" => "list-users",
        ]);
        $call->assertJsonFragment([
            "name" => "add-user",
        ]);
    }

    public function test_listar_todos_los_roles()
    {
        $call = $this->actingAs(factory(User::class)->create())->json("GET", "/api/v1/roles");
        $call->assertJsonFragment([
            "name" => "monitorista",
        ]);

    }

    public function test_crear_nuevo_rol()
    {
        $call = $this->actingAs(factory(User::class)->create())->json("POST", "/api/v1/roles", [
            "name" => $this->faker->firstNameMale,
            "permissions" => [
                "list-users"
            ]
        ]);

        $call->assertJsonFragment([
                "list-users"

        ]);
    }

    public function test_actualizar_permisos_de_un_rol()
    {
        $role = factory(Role::class)->create();

        $call = $this->actingAs(factory(User::class)->create())->json("PUT", "/api/v1/roles/$role->id", [
            "name" => $this->faker->firstNameMale,
            "permissions" => [
                "add-user"
            ]
        ]);

        $call->assertJsonFragment([
            "name" =>
                "add-user"

        ]);
    }

    public function test_ver_permisos_de_un_rol()
    {
        $role = factory(Role::class)->create();
        $role->givePermissionTo("list-users");
        $call = $this->actingAs(factory(User::class)->create())->json("GET", "/api/v1/roles/$role->id");

        $call->assertJsonFragment([
            "name" => "list-users"
        ]);
    }

    public function test_asignar_rol_a_usuario()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $role->givePermissionTo("list-users");
        $call = $this->actingAs(factory(User::class)->create())->json("POST", "/api/v1/roles/$role->id/user", [
            "user_id" => $user->id
        ]);

        $call->assertStatus(200);


    }
}
