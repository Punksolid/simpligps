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

        foreach ($permissions as $permission){
            $permission = new Permission(["name" => $permission, "guard_name" => "web"]);
            $permission->save();
        }

        $roles = [
            "monitorista"
        ];
        foreach ($roles as $role){
            $roles = new Role(["name" => $role, "guard_name" => "web"]);
            $roles->save();
        }
    }
}
