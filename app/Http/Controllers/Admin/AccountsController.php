<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
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
        $accounts = Account::paginate();

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {

        $account = Account::create([
            "uuid" => \Illuminate\Support\Str::uuid()
        ]);

        \Artisan::call("trm:new_account");

        return AccountResource::make($account);

    }


    /**
     * Display the specified account.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($account_id)
    {

        $account = Account::findOrFail($account_id);

        \Artisan::call("trm:delete_account", [
            "easyname" => $account->easyname
        ]);


        $account->delete();

        return AccountResource::make($account);
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
}
