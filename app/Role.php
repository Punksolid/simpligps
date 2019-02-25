<?php

namespace App;

use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use UsesTenantConnection;
//
//    public function syncPermissions(array ...$permissions)
//    {
//
//    }

    /**
     * Remove all current permissions and set the given ones.
     *
     * @param string|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
     * @return $this
     */
    public function syncPermissions(...$permissions)
    {

        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
//        return
    }

}
