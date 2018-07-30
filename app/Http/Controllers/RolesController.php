<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create(["name" => $request->name]);
        $role->syncPermissions($request->permissions);
        $role = $role->fresh("permissions");
        return response()->json([
            "name" => $role->name,
            "permissions" => PermissionResource::collection($role->permissions)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with("permissions")->findOrFail($id);
        return response()->json([
            "name" => $role->name,
            "permissions" => PermissionResource::collection($role->permissions)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->syncPermissions($request->permissions);
        $role = $role->fresh("permissions");
        return response()->json([
            "name" => $role->name,
            "permissions" => PermissionResource::collection($role->permissions)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignToUser(Role $role, Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($role->name);

        return response()->json(true);
    }
}
