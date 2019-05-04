<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Device;
use App\Events\AccountCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Setting;
use App\User;
use App\Wialon;
use function foo\func;
use Hyn\Tenancy\Models\Website;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * Class AccountsController
 * @package App\Http\Controllers\Admin
 * @resource Accounts|Cuentas
 */
class AccountsController extends Controller
{

    /**
     * Display a listing of the account.
     *
     * @return \Illuminate\Http\Response
     * @response {
     *  "token": "eyJ0eXAi…",
     *  "roles": ["admin"]
     * }
     */
    public function index()
    {
        $request = request();
        $account_query = Account::query()->orderByDesc('created_at');
        if ($request->filled('easyname')){
            $account_query->where('easyname', $request->easyname);
        }
        if ($request->filled('uuid')){
            $account_query->where('uuid', $request->get('uuid'));
        }

        $accounts = $account_query->paginate($request->get('limit', 10));

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return AccountResource
     */
    public function store(AccountRequest $request)
    {
        $account = new Account([
            "easyname" => $request->easyname
        ]);

        $account->createAccount();

        $user = User::firstOrCreate([
            "email" => $request->email
        ], [
            'email' => $request->email,
            'name' => '',
            'lastname' => '',
            'password' => bcrypt(Str::random(10))
        ]);

        $account->addUser($user);

        event(new AccountCreatedEvent($user, $account));

        return AccountResource::make($account);

    }


    /**
     * Display the specified account.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {

        $account->load(['users', 'licenses']);
        if ($account->hasDatabaseAccesible()){

            $account->wialon_key = $account->getTenantData(Setting::class)->getWialonToken();
        }

        return AccountResource::make($account);

    }

    /**
     * Update the specified account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Elimina cuenta
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {

        $account->delete();

        return AccountResource::make($account);
    }

    public function forceDestroy(Request $request, Account $account)
    {
        $validated = $this->validate($request, [
            'uuid' => 'required'
        ]);

        if ($account->delete()){
            \Artisan::call("trm:delete_account", [
                'uuid' => $validated['uuid']
            ]);

            return AccountResource::make($account);
        }

        return new \Exception("An error ocurred");
    }

    /**
     * Agrega datos fiscales
     * @param Account $account
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fiscal(Account $account, Request $request)
    {

        $account->update([
            "bulk" => $request->only(
                "business_name",
                "contact",
                "address",
                "phone",
                "business_type"
            )
        ]);

        return response($account->fresh()->bulk);
    }

    /**
     * Devuelve un listado de cuentas activas por su lapse
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function activeAccounts()
    {
        $accounts = Account::active()->get();

        return AccountResource::collection($accounts);
    }

    /**
     * Próximos a expirar en 7 dias
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @response {
     * "data": [
     * {
     * "id": 1,
     * "easyname": "ut",
     * "uuid": "9967c79f-8188-3598-b0ec-ef8232410a6b"
     * }
     * ]
     * }
     */
    public function nearToExpire()
    {
        $accounts = Account::with("activeLicenses")->nearToExpire()->get();

        return AccountResource::collection($accounts);
    }

    public function addUser(Account $account, Request $request)
    {
        $this->validate($request, [
            "email" => "required|email"
        ]);

        $user = User::firstOrCreate([
            "email" => $request->email
        ],[
            "name" => "",
            "email" => $request->email,
            "lastname" => $request->email,
            "password" => bcrypt(Str::random(16))
        ]);

        $account->addUser($user);

        return response()->json([
            "data" => [
                "user" => $user
            ]
        ]);
    }


    public function general(Account $account, Request $request)
    {
        $this->validate($request,[
           "wialon_key" => "required",
           "import" => "required|bool"
        ]);
        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);

        $setting_wialon_key = Setting::where('key', 'wialon_key')->first();
        $setting_wialon_key->value = $request->wialon_key;

        if ($setting_wialon_key->save()){
            if ($request->import){
                $wialon_devices = new Wialon($request->wialon_key);
                $wialon_devices->import();
            }
            return response([
                'data' => [
                    'message' => 'Se actualizó correctamente',
                    'wialon_key' => $request->wialon_key
                ]
            ]);
        } else {
            return response('Aconteció un error');
        }

    }

    public function getSettings(Account $account)
    {
        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);

        $settings = Setting::all();

        return response([
            'data' => [
                'wialon_key' => $settings->where('key','wialon_key')->first()->value
            ]
        ]);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return AccountResource
     */
    public function storeFromEcommerce(Request $request)
    {
        $validatedDataArry = $this->validate($request, [
            'email' => 'required|email'
        ]);
        $account = new Account([
            "easyname" => $validatedDataArry['email']
        ]);

        $account->createAccount();

        $user = User::firstOrCreate([
            "email" => $validatedDataArry['email']
        ], [
            'email' => $validatedDataArry['email'],
            'name' => '',
            'lastname' => '',
            'password' => bcrypt(Str::random(10))
        ]);

        $account->addUser($user);
        
        event(new AccountCreatedEvent($user, $account));

        return AccountResource::make($account);
    }
}


