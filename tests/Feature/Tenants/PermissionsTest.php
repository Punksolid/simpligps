<?php

namespace Tests\Feature;

use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Permission;
use App\Role;
use App\User;
use Tests\Tenants\TestCase;


class PermissionsTest extends TestCase
{
    var $user;


    protected function setUp():void
{
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user, "api");
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_listar_todos_los_permisos()
    {
        $this->withoutExceptionHandling();

        $call = $this->getJson(
            "/api/v1/permissions");
        $call->assertJsonFragment([
            "name" => "POST|api/v1/devices",
        ]);
        $call->assertJsonFragment([
            "name" => "POST|api/v1/contacts",
        ]);
    }

    public function test_listar_todos_los_roles()
    {
        $call = $this->getJson("/api/v1/roles");

        $call->assertSuccessful();

    }

    public function test_crear_nuevo_rol()
    {
        $this->withoutExceptionHandling();
        $permission_name = Permission::firstOrFail()->name;
        $call = $this->postJson("/api/v1/roles", [
            "name" => $this->faker->unique()->firstNameMale . $this->faker->unique()->word,
            "permissions" => [
                $permission_name
            ]
        ]);

        $call->assertJsonFragment([
            $permission_name
        ]);
    }

    public function test_actualizar_permisos_de_un_rol()
    {
        $this->withoutExceptionHandling();
        $role = factory(Role::class)->create(["guard_name" => "api"]);

        $new_role = [
            "name" => $this->faker->firstNameMale,
            "permissions" => [
                "POST|api/v1/trips"
            ]
        ];
        $call = $this->putJson("/api/v1/roles/$role->id", $new_role);

        $call->assertJsonFragment([
            "name" => $new_role["name"]
        ]);
    }

    public function test_ver_permisos_de_un_rol()
    {
        $role = factory(Role::class)->create();
        $permission = factory(Permission::class)->create();
        $role->givePermissionTo($permission->name);
        $call = $this->json("GET", "/api/v1/roles/$role->id");

        $call->assertJsonFragment([
            "name" => $permission->name
        ]);
    }

    public function test_asignar_rol_a_usuario()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create(["guard_name" => "api"]);
        $permission = factory(Permission::class)->create(["guard_name" => "api"]);
        $role->givePermissionTo($permission->name);
        $call = $this->postJson( "/api/v1/roles/$role->id/user", [
            "user_id" => $user->id
        ]);

        $call->assertStatus(200);

    }

    public function test_usuario_puede_eliminar_rol_de_permisos()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $call = $this->actingAs($user)
            ->json("DELETE", "/api/v1/roles/$role->id");
        $call->assertJsonStructure([
            "message"
        ]);
        $call->assertStatus(200);
    }

    public function test_usuario_puede_editar_permisos_por_usuario()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $permission = factory(Permission::class)->create(["guard_name" => "api"]);
        $permission2 = factory(Permission::class)->create(["guard_name" => "api"]);

        $call = $this
            ->putJson("/api/v1/permissions/user_sync/$user->id", [
                "permissions" => [
                    $permission->name,
                    $permission2->name
                ]
            ]);
        $call->assertJsonStructure([
            "data" => [
                "*" => []
             ]
        ]);
        $call->assertStatus(200);
    }

    public function test_ver_permisos_del_usuario_loggeado()
    {
        $this->markTestIncomplete("Faltan los permisos por tenant");
        $user = factory(User::class)->create();
        $call = $this->actingAs($user)->json("GET","/api/v1/me/permissions");

        $call->assertJsonStructure([
            "data" => [
                "*" => []
            ]
        ]);
    }
}
