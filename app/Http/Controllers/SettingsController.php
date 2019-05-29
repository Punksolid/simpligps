<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingsResource;
use App\Setting;
use App\Wialon;
use Illuminate\Http\Request;

/**
 * Class SettingsController
 * @package App\Http\Controllers
 * @resource Settings
 */
class SettingsController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @todo REFACTOR
     */
    public function general(Request $request)
    {
        $this->validate($request, [
            "wialon_key" => "required",
            "import" => "required|bool"
        ]);
        $setting_wialon_key = Setting::where('key', 'wialon_key')->first();
        $setting_wialon_key->value = $request->wialon_key;
        if ($setting_wialon_key->save()) {
            if ($request->import) {
                $wialon = new Wialon($request->wialon_key);
                $wialon->import();
//                $wialon->importNotifications(); //como existe una capa intermedia de validacion, no es necesario importar notificaciones
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

    public function getSettings()
    {
        $settings = Setting::all();

        return response([
            'data' => [
                'wialon_key' => $settings->where('key', 'wialon_key')->first()->value
            ]
        ]);
    }
}
