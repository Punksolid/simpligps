<?php

namespace App\Http\Controllers;

use App\Exports\TripsReport;
use App\Http\Resources\TripResource;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Excel;

class TripsReportsController extends Controller
{
    public function index(Request $request, Excel $excel )
    {
        $query_trip = Trip::query();
        if ($request->filled('start_date')){
            $query_trip = $query_trip->betweenDates($request->get('start_date'), $request->get('end_date'));
        }
        if ($request->filled('origin_id')) {
            $query_trip = $query_trip->byOriginId($request->get('origin_id'));
        }
        if ($request->filled('destination_id')) {
            $query_trip = $query_trip->byDestinationId($request->get('destination_id'));
        }
        if ($request->filled('carrier_id')) {
            $query_trip = $query_trip->where('carrier_id', $request->get('carrier_id'));
        }
        if ($request->filled('tag')) {
            $query_trip = $query_trip->withAnyTags([
                $request->get('tag')
            ]);
        }
        $trips = $query_trip->get();

        if ($trips->count()) {
            return $excel->download(
                new TripsReport($query_trip->get()),
                'general_report.xlsx'
            );
        }

        throw ValidationException::withMessages([
            'message' => [
                'There are no trips with the given criteria'
            ]
        ]);


    }
}
