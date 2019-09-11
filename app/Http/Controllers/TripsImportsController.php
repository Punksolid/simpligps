<?php

namespace App\Http\Controllers;

use App\Imports\TripImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;


class TripsImportsController extends Controller
{
    public function store(Request $request)
    {

        $file = $request->file('trips');
        \DB::connection('tenant')->beginTransaction();
        try {
            Excel::import(
                new TripImport($file),
                    $file->getRealPath()
            );
        } catch (\Exception $exception) {

            \DB::connection('tenant')->rollBack();

            throw $exception;
        }

        \DB::connection('tenant')->commit();



        return response()->json('ok');
    }
}
