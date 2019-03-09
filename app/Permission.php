<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\PermissionRegistrar as OriginalPermissionRegistrar;
use App\Permission\PermissionRegistrar;
use Illuminate\Support\Collection;


class Permission extends SpatiePermission
{
    use UsesTenantConnection;

    public function roles(): BelongsToMany
    {
        $database = $this->getConnection()->getDatabaseName();
        $table_name = config('permission.table_names.role_has_permissions');

        return $this->belongsToMany(
            Role::class,
            "$database.$table_name"
        );
    }

    /**
     * Find a permission by its name (and optionally guardName).
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     *
     * @return \Spatie\Permission\Contracts\Permission
     */
    public static function findByName(string $name, $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['name' => $name, 'guard_name' => $guardName])->first();
        if (! $permission) {
            throw PermissionDoesNotExist::create($name, $guardName);
        }

        return $permission;
    }

    /**
     * Get the current cached permissions.
     */
    protected static function getPermissions(array $params = []): Collection
    {

        return app(PermissionRegistrar::class)
            ->getPermissions($params);
    }

    public function getRoleClass()
    {
//        if (! isset($this->roleClass)) {
//            $this->roleClass = app(PermissionRegistrar::class)->getRoleClass();
//        }
        return $this->roleClass = Role::class;
//        return $this->roleClass;
    }
}
