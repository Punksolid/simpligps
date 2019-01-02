<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use Illuminate\Http\Request;
use Punksolid\Wialon\Wialon;

class UnitsController extends Controller
{
    public function listUnits()
    {

        $units = (new Wialon())->listUnits();
        return UnitResource::collection($units);
    }

    public function listUnitsLocalization()
    {
        $units = (new Wialon())->listUnits();

        return UnitResource::collection($units);
    }
}
