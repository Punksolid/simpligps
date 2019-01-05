<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use Illuminate\Http\Request;
use Punksolid\Wialon\Wialon;

class UnitsController extends Controller
{
    /**
     * Listar unidades con datos básicos
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listUnits()
    {

        $units = (new Wialon())->listUnits();
        return UnitResource::collection($units);
    }

    /**
     * Listar unidades mostrando ubicación
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listUnitsLocalization()
    {
        $units = (new Wialon())->listUnits();

        return UnitResource::collection($units);
    }
}
