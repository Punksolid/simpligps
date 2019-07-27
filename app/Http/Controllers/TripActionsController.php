<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

class TripActionsController extends Controller
{
    public function giveExit(Trip $trip, Request $request)
    {

        $this->validate($request, [
            'enable_automatic_updates' => 'required|bool'
        ]);
        if ($request->enable_automatic_updates){
            if ($trip->validateAllReferalAttributes()){
                return response()->json([
                    'data' => 'Exit with automatic updates were created succesfully.'
                ]);
            }
        }

    }
}
