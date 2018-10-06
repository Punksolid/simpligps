<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\LicenseRequest;
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
     */
    public function index()
    {
        //
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
        return response($license);
    }

    /**
     * Show the form for editing the specified LICENSE.
     *
     * @param  \App\License $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        //
    }

    /**
     * Update the specified LICENSE in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\License $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        //
    }

    /**
     * Remove the specified LICENSE from storage.
     *
     * @param  \App\License $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        //
    }

    public function assignToAccount(License $license, Request $request)
    {
        $account = Account::find($request->account_id);


        if ($license->assignToAccount($account)){
            return response(["data" =>  "Se asignó con exito"]);
        }

        return response()->status(500);
    }

    public function revoke(License $license, Request $request)
    {
        $account = Account::findOrFail($request->account_id);


        if ($license->revoke($account)){
            return response(["data" =>  "La licencia ha sido revocada"]);
        }

        return response()->status(500);
    }
}
