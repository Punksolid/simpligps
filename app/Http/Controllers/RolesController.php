<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Request;
use App\Role;

/**
 * Class RolesController.
 *
 * @resource Role
 */
class RolesController extends Controller
{
    /**
     * Display a listing of the Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json($roles);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        $role = $role->fresh('permissions');
        return response()->json([
            'name' => $role->name,
            'permissions' => PermissionResource::collection($role->permissions),
        ]);
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return response()->json([
            'name' => $role->name,
            'permissions' => PermissionResource::collection($role->permissions),
        ]);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findById($id, 'api');
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        $role = $role->fresh('permissions');
        return response()->json([
            'name' => $role->name,
            'permissions' => PermissionResource::collection($role->permissions),
        ]);
    }

    /**
     * Elimina rol aka perfiles de permisos.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return response([
                'message' => 'rol eliminado',
            ]);
        }
        return response([
            'message' => 'falló al eliminar el rol',
        ]); //todo cambiar por thwrow exception
    }

    /**
     * Asigna rol a usuario.
     *
     * @param Role    $role
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignToUser(Role $role, Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($role->name);

        return response()->json(true);
    }
}
