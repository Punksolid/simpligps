<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\LicenseRequest;
use App\Http\Resources\LicenseResource;
use App\License;
use Illuminate\Http\Request;
use Psy\Util\Str;
use Ramsey\Uuid\Uuid;

/**
 * Class LicenseController
 * @package App\Http\Controllers
 * @resource Licensing
 */
class LicenseController extends Controller
{
    /**
     * Display a listing of the LICENSE.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $licenses = License::paginate();

        return LicenseResource::collection($licenses);
    }

    /**
     * Store a newly created LICENSE in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenseRequest $request)
    {

        $license = License::make($request->all());
        $license->uuid = \Illuminate\Support\Str::uuid();
        $license->save();

        return response()->json([
            "data" => $license
        ]);
    }

    /**
     * Display the specified LICENSE.
     *
     * @param  \App\License $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        return LicenseResource::make($license->load('accounts'));
    }



    /**
     * Remove the specified LICENSE from storage.
     *
     * @param  \App\License $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        //@todo COLOCAR VALIDACIONES de relaciones antes de elimianar
    }

    /**
     * Asigna Licencia a Cuenta
     * @param License $license
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|int
     */
    public function assignToAccount(License $license, Request $request)
    {
        $account = Account::find($request->account_id);

        if ($license->assignToAccount($account)){
            return response(["data" =>  "Se asignó con exito"]);
        }

        return response()->status(500);
    }

    /**
     * Revoca licencia License, Request
     * @param License $license
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|int
     */
    public function revoke(License $license, Request $request)
    {
        $account = Account::findOrFail($request->account_id);


        if ($license->revoke($account)){
            return response(["data" =>  "La licencia ha sido revocada"]);
        }

        return response()->status(500);
    }
}
