<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Events\AccountCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Setting;
use App\User;
use App\Wialon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class AccountsController.
 *
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
    public function index(Request $request)
    {
        $account_query = Account::query()->orderByDesc('created_at');
        if ($request->filled('easyname')) {
            $account_query->where('easyname', $request->easyname);
        }
        if ($request->filled('uuid')) {
            $account_query->where('uuid', $request->get('uuid'));
        }

        $accounts = $account_query->orderByDesc('created_at')->paginate($request->get('limit', 10));

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return AccountResource
     */
    public function store(AccountRequest $request)
    {
        $account = new Account([
            'easyname' => $request->easyname,
        ]);

        $account->createAccount();

        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'email' => $request->email,
            'name' => '',
            'lastname' => '',
            'password' => bcrypt(Str::random(10)),
        ]);

        $account->addUser($user);

        event(new AccountCreatedEvent($user, $account));

        return AccountResource::make($account);
    }

    /**
     * Display the specified account.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $account->load(['users', 'licenses', 'activeLicenses']);
        if ($account->hasDatabaseAccesible()) {
            $account->wialon_key = $account->getTenantData(Setting::class)->getWialonToken();
        }

        return AccountResource::make($account);
    }

    /**
     * Update the specified account in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Elimina cuenta.
     *
     * @param Account $account
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Account $account, Request $request)
    {
        if (true === $request->force_destroy) {
            $this->validate($request, [
                'uuid' => 'required',
            ]);
            $account->deleteWithDatabase();
        }
        $account->delete();

        return AccountResource::make($account);
    }

    /**
     * Agrega datos fiscales.
     *
     * @param Account $account
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fiscal(Account $account, Request $request)
    {
        $account->update([
            'bulk' => $request->only(
                'business_name',
                'contact',
                'address',
                'phone',
                'business_type'
            ),
        ]);

        return response($account->fresh()->bulk);
    }

    /**
     * Devuelve un listado de cuentas activas por su lapse.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function activeAccounts()
    {
        $accounts = Account::active()->get();

        return AccountResource::collection($accounts);
    }

    /**
     * Próximos a expirar en 7 dias.
     *
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
        $accounts = Account::with('activeLicenses')->nearToExpire()->get();

        return AccountResource::collection($accounts);
    }

    public function addUser(Account $account, Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => '',
            'email' => $request->email,
            'lastname' => $request->email,
            'password' => bcrypt(Str::random(16)),
        ]);

        $account->addUser($user);

        return response()->json([
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    public function general(Account $account, Request $request)
    {
        $this->validate($request, [
           'wialon_key' => 'required',
           'import' => 'required|bool',
        ]);
        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);

        $setting_wialon_key = Setting::where('key', 'wialon_key')->first();
        $setting_wialon_key->value = $request->wialon_key;

        if ($setting_wialon_key->save()) {
            if ($request->import) {
                $wialon_devices = new Wialon($request->wialon_key);
                $wialon_devices->import();
            }

            return response([
                'data' => [
                    'message' => 'Se actualizó correctamente',
                    'wialon_key' => $request->wialon_key,
                ],
            ]);
        } else {
            return response('Aconteció un error');
        }
    }
}
