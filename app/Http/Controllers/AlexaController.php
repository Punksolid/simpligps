<?php

namespace App\Http\Controllers;

use App\Account;
use Hyn\Tenancy\Environment;
use Illuminate\Http\Request;
use Spatie\Geocoder\Geocoder;

class AlexaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $tenant_id)
    {
        \Illuminate\Support\Facades\Log::info('test', $request->toArray());
//    amzn1.ask.skill.4e3f7b60-c9bc-49d3-a8f1-d48f88da7087
        $account = Account::where("uuid", $tenant_id)->firstOrFail();
        $environment = app(Environment::class);
        $environment->tenant($account);
        /** @var \Punksolid\Wialon\Unit $device */
        $device = \Punksolid\Wialon\Unit::all()->first();
//    $address = app('geocoder')->reverse($device->lat,$device->lon);
        $client = new \GuzzleHttp\Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));
        $address = $geocoder->getAddressForCoordinates($device->lat, $device->lon);
//    dd($address);
        return new JsonResponse([
            "response" => [
                "outputSpeech" => [
                    "type" => "PlainText",
                    "text" => "Tu dispositivo llamado $device->nm está en {$address['formatted_address']}"
                ]
            ]
        ]);
    }
}
