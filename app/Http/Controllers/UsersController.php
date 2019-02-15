<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UsersResource;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersController
 * @package App\Http\Controllers
 * @resource User
 */
class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     * filtra usuarios por parametros enviados via get query parameters: "name","email","lastname","username"
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = User::query()->orderByDesc("created_at");
        if ($request->filled('email')){
            $query->where($request->all(['email']));
        }
        if ($request->filled('name')){
            $query->where($request->all(['name']));
        }
        if ($request->filled('lastname')){
            $query = $query->whereHas("profile",function ($query_profile) use($request){
                $query_profile->where($request->all(["lastname"]));
            });
        }
        if ($request->filled('username')){
            $query = $query->whereHas("profile",function ($query_profile) use($request){
                $query_profile->where($request->all(["username"]));
            });
        }


        $users = $query->paginate();

        return UsersResource::collection($users);
    }
 
    /**
     * Store a newly created users in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->profile()->save(new Profile($request->all()));

        return UsersResource::make($user->fresh());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @deprecated para cambiar el password del usuario loggeado MeController@changePassword
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            "password" => "required|confirmed"
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        return response()->json($user->save());

    }
    /**
     * Display the specified users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified users in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        $user->profile()->save(new Profile($request->all()));

        return UsersResource::make($user->fresh());
    }

    /**
     * Remove the specified users from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::find($id)->delete()) {
            return response(["data" => "Deleted user"]);
        }

        return response(["data" => "Error"])->setStatusCode(500);
    }
}
