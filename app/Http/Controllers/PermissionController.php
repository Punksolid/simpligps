<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Lista todos los permisos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return PermissionResource::collection($permissions);

    }

    /**
     * Muestra
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Actualiza los permisos individuales de un usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function userSync(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);
        return response($user->getAllPermissions()->pluck("name"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
