<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Wialon;

class WialonController extends Controller
{
    public function getResources()
    {
        $setting_wialon_key = optional(Setting::where('key', 'wialon_key')->first())->value;

        $resources = Resource::all();

        return $resources;
    }
}
