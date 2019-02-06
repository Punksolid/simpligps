<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use App\Setting;
use Illuminate\Http\Request;
use Punksolid\Wialon\Unit;
use Punksolid\Wialon\Wialon;

/**
 * Class UnitsController
 * @package App\Http\Controllers
 * @resource Unit
 */
class UnitsController extends Controller
{

    /**
     * UnitsController constructor.
     */
    public function __construct()
    {
        $token = (new \App\Setting)->getWialonToken();
        config(['services.wialon.token' => $token]);
    }


    /**
     * Listar unidades con datos básicos
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listUnits()
    {

        $units = Unit::all();

        return UnitResource::collection($units);
    }

    /**
     * Listar unidades mostrando ubicación
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listUnitsLocalization()
    {
        $units = Unit::all();

        return UnitResource::collection($units);
    }
}
