<?php

namespace App\Http\Controllers;

use App\Account;
use App\Events\AddedUserToAccount;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class UsersController
 * @package App\Http\Controllers
 * @resource User
 */
class UsersController extends Controller
{
    private $account;
    public $repository;

    public function __construct()
    {

        try {
            $this->account = Account::whereUuid(\request()->header("X-Tenant-Id"))->firstOrFail();
            $this->repository = $this->account->users();
        }catch (\Exception $e){
            \Log::alert("No se pudo especificar repositorio");
        }
        parent::__construct();
    }


    /**
     * Display a listing of the users.
     * filtra usuarios por parametros enviados via get query parameters: "name","email","lastname","username"
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->repository->orderByDesc("created_at") ;

        if ($request->filled('email')){

            $query->where($request->all(['email']));
        }
        if ($request->filled('name')){
            $query->where($request->all(['name']));
        }
        if ($request->filled('lastname')){
            $query->where($request->all(['lastname']));
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
        $user = User::firstOrCreate([
            'email' => $request->email,
        ],[
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'password' => bcrypt(Str::random(15)),
        ]);
        if ($this->account->userExists($user)){
            throw ValidationException::withMessages([
                "email"=> [
                    "User already exists"
                ]
            ]);
        }

        if ($this->account->addUser($user)){
            event(AddedUserToAccount::class);
        };

        return UsersResource::make($user->fresh());
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
        $user = User::findOrFail($id);
        $this->account->removeUser($user);

        return response(["data" => "Deleted user"]);

    }
}
