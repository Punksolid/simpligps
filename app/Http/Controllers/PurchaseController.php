<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use OpenApi\Annotations\License;
use App\License as AppLicense;
use Illuminate\Support\Str;
use App\Events\AccountCreatedEvent;
use App\Http\Resources\AccountResource;

class PurchaseController extends Controller
{

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return AccountResource
     */
    public function storeFromEcommerce(Request $request)
    {
        $validatedDataArry = $this->validate($request, [
            'billing.email' => 'required|email',
            'line_items.0.sku' => 'required'
        ]);


        // $license = $request->line_items[0]["sku"]; is the buyed item
        $license = AppLicense::where("name", $request->line_items[0]["sku"])->firstOrFail();
        $email = $request->billing["email"];
        $purchase = Purchase::create([
            "email" => $request->billing["email"],
            "audit" => $request->all()
        ]);
        $account = new \App\Account([
            "easyname" => $request->billing["email"]
        ]);

        $account->createAccount();
        $account->addLicense($license);
        $user = \App\User::firstOrCreate([
            "email" => $request->billing["email"]
        ], [
            'email' => $request->billing["email"],
            'name' => '',
            'lastname' => '',
            'password' => bcrypt(Str::random(10))
        ]);

        $account->addUser($user);

        event(new AccountCreatedEvent($user, $account));

        return AccountResource::make($account);
    }
}
