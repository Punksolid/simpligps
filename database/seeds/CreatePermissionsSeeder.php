<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "list-users",
            "add-user"
        ];
        $permissions_routes = [
            "POST|api/v1/login",
            "GET|api/v1/me",
            "POST|api/v1/password/change",
            "POST|api/v1/password/send_email",
            "GET|api/v1/permissions",
            "PUT|api/v1/permissions/user_sync/{user}",
            "POST|api/v1/roles",
            "GET|api/v1/roles",
            "DELETE|api/v1/roles/{role}",
            "PUT|PATCH|api/v1/roles/{role}",
            "GET|api/v1/roles/{role}",
            "POST|api/v1/roles/{role}/user",
            "POST|api/v1/trips",
            "POST|api/v1/trips/upload",
            "PUT|api/v1/trips/{trip}",
            "DELETE|api/v1/trips/{trip}",
            "POST|api/v1/users",
            "GET|api/v1/users"
        ];


        foreach ($permissions as $permission) {
            $permission = new Permission(["name" => $permission, "guard_name" => "web"]);
            $permission->save();
        }

        $roles = [
            "monitorista"
        ];
        foreach ($roles as $role) {
            $roles = new Role(["name" => $role, "guard_name" => "web"]);
            $roles->save();
        }
    }
}
