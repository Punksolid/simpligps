<?php

namespace App\Http\Controllers;

use App\Account;
use App\Device;
use Hyn\Tenancy\Environment;
use Illuminate\Http\JsonResponse;
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
        if ($request->input('request.type') === 'LaunchRequest') {
            return $this->welcome($request);
        }

//    amzn1.ask.skill.4e3f7b60-c9bc-49d3-a8f1-d48f88da7087
        $account = Account::where("uuid", $tenant_id)->firstOrFail();

        $environment = app(Environment::class);
        $environment->tenant($account);


//        $client = new \GuzzleHttp\Client();
//        $geocoder = new Geocoder($client);
        /** @var Geocoder $geocoder */
        $geocoder = resolve(Geocoder::class);
        $geocoder->setApiKey(config('geocoder.key'));


        $device_name_requested = $request->input('request.intent.slots.gps_device.value');
        $device = Device::where('name','LIKE' , "%$device_name_requested%")->first();
        /** @var Device $device */
        $location = $device->getLocation();
        if ($location['lat'] !== null && $location['lon'] !== null) {
            $address = $geocoder->getAddressForCoordinates($location['lat'], $location['lon']);
            return new JsonResponse([
                "response" => [
                    "outputSpeech" => [
                        "type" => "PlainText",
                        "text" => "La ubicación del $device_name_requested, es {$address['formatted_address']}"
                    ]
                ]
            ]);

        }

        return $this->fallbackMessage();

    }

    private function welcome($request): ?JsonResponse
    {
            return new JsonResponse([
                "response" => [
                    "outputSpeech" => [
                        "type" => "PlainText",
                        "text" => "Welcome to Simpli G.P.S."
                    ]
                ]
            ]);
    }

    private function fallbackMessage()
    {
        return new JsonResponse([
            "response" => [
                "outputSpeech" => [
                    "type" => "PlainText",
                    "text" => "Lo sentimos no pudo ser solucionado"
                ]
            ]
        ]);
    }
}
