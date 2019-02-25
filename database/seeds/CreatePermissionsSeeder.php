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
            "POST  |api/v1/login",
            "POST  |api/v1/logout",
            "POST  |api/v1/password/send_email",
            "POST  |api/v1/password/change",
            "POST  |api/v1/webhook/alert",
            "POST  |api/v1/me/change_password",
            "POST  |api/v1/devices/{device}/link_unit",
            "POST  |api/v1/devices",
            "PATCH |api/v1/devices/{device}",
            "DELETE|api/v1/devices/{device}",
            "POST  |api/v1/contacts/{contact}/tags",
            "POST  |api/v1/contacts",
            "PATCH |api/v1/contacts/{contact}",
            "DELETE|api/v1/contacts/{contact}",
            "PUT   |api/v1/permissions/user_sync/{user}",
            "POST  |api/v1/roles/{role}/user",
            "POST  |api/v1/roles",
            "PATCH |api/v1/roles/{role}",
            "DELETE|api/v1/roles/{role}",
            "POST  |api/v1/trips/convoys",
            "POST  |api/v1/trips/upload",
            "POST  |api/v1/trips/{trip}/tags",
            "POST  |api/v1/trips/filtered_with_tags",
            "POST  |api/v1/trips/{trip}/traces",
            "POST  |api/v1/trips",
            "PATCH |api/v1/trips/{trip}",
            "DELETE|api/v1/trips/{trip}",
            "POST  |api/v1/operators",
            "PATCH |api/v1/operators/{operator}",
            "DELETE|api/v1/operators/{operator}",
            "POST  |api/v1/geofences",
            "POST  |api/v1/notification_types",
            "PATCH |api/v1/notification_types/{notification_type}",
            "POST  |api/v1/carriers",
            "PATCH |api/v1/carriers/{carrier}",
            "DELETE|api/v1/carriers/{carrier}",
            "POST  |api/v1/places",
            "PATCH |api/v1/places/{place}",
            "DELETE|api/v1/places/{place}",
            "POST  |api/v1/settings",
            "POST  |api/v1/wialon/notifications",
            "POST  |api/v1/external/devices/{device}/localization",
            "POST  |api/v1/external/devices",

        ];


        foreach ($permissions as $permission) {
            $permission = new Permission(["name" => $permission, "guard_name" => "api"]);
            $permission->save();
        }

        $roles = [
            "monitorista"
        ];
        foreach ($roles as $role) {
            $roles = new Role(["name" => $role, "guard_name" => "api"]);
            $roles->save();
        }
    }
}
