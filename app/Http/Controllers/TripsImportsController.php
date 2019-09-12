<?php

namespace App\Http\Controllers;

use App\Imports\TripImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;


class TripsImportsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'trips' => 'required|file'
        ]);

        $file = $request->file('trips');
        
        Storage::disk('tenant')->put('readme.md', 'Hi John.');
        \DB::connection('tenant')->beginTransaction();
        try {
            Excel::import(
                new TripImport($file),
                    $file->getRealPath(),
                    null,
                    \Maatwebsite\Excel\Excel::XLSX
            );
        } catch (\Exception $exception) {

            \DB::connection('tenant')->rollBack();

            throw $exception;
        }

        \DB::connection('tenant')->commit();



        return response()->json('ok');
    }
}
