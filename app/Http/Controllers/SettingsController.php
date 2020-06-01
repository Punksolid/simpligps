<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Http\Resources\SettingsResourceCollection;
use App\Jobs\Traccar\ImportDevices;
use App\Setting;
use App\Wialon;
use Illuminate\Http\Request;

/**
 * Class SettingsController.
 *
 * @resource Settings
 */
class SettingsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @todo REFACTOR
     */
    public function general(Request $request)
    {
        $this->validate($request, [
            'wialon_key' => 'required',
            'import' => 'required|bool',
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
                    'wialon_key' => $request->wialon_key,
                ],
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
                'wialon_key' => $settings->where('key', 'wialon_key')->first()->value,
            ],
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function putUpdate(Request $request)
    {
        foreach ($request->all() as $key => $value){
            Setting::where('key', $key)->updateOrCreate([
                'key' => $key
            ], [
                'value' => $value,
                'description' => "$key:$value"
            ]);
        }

        $this->proccessImports();


        $settings = Setting::all();

        return SettingResource::collection($settings);

    }

    private function proccessImports()
    {
        $traccar_import = Setting::query()->where('key', 'traccar_import')->firstOrFail();

        if ($traccar_import->value) {
            $this->dispatch(ImportDevices::class);
        }

    }
}
