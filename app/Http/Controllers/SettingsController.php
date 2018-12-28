<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingsResource;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function general(Request $request)
    {
        $setting_wialon_key = Setting::where('key', 'wialon_key')->first();
        $setting_wialon_key->value = $request->wialon_key;
        if ($setting_wialon_key->save()){

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
                'wialon_key' => $settings->where('key','wialon_key')->first()->value
            ]
        ]);
    }
}
