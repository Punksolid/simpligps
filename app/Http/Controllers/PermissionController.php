<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

/**
 * Class PermissionController.
 *
 * @resource Permission
 */
class PermissionController extends Controller
{
    /**
     * Lista todos los permisos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return PermissionResource::collection($permissions);
    }

    /**
     * Actualiza los permisos individuales de un usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Permission          $permission
     *
     * @return \Illuminate\Http\Response
     */
    public function userSync(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);
        return response()->json(['data' => $user->getAllPermissions()->pluck('name')]);
    }
}
