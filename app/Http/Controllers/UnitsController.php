<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use Punksolid\Wialon\Unit;

/**
 * Class UnitsController.
 *
 * @resource Unit
 */
class UnitsController extends Controller
{
    /**
     * Listar unidades con datos básicos.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listUnits()
    {
        $units = Unit::all();

        return UnitResource::collection($units);
    }

    /**
     * Listar unidades mostrando ubicación.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listUnitsLocalization()
    {
        $units = Unit::all();

        return UnitResource::collection($units);
    }
}
