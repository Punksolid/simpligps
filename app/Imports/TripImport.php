<?php

namespace App\Imports;

use App\CreateTrip;
use App\Http\Requests\TripRequest;
use App\Rules\NoTimeOverlap;
use App\Trip;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TripImport implements ToModel, WithValidation, WithHeadingRow
{
    public $trip_file;

    public function __construct($trip_file)
    {

        $this->trip_file = $trip_file;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws ValidationException
     */
    public function model(array $row)
    {

            $trip_request = request()->replace([
                'rp' => $row['rp'],
                'invoice' => $row['invoice'],
                'client_id' => $row['client'],
                'mon_type' => $row['monitoring_type'],
                'carrier_id' => $row['carrier'],
                'origin_id' => $row['origin'],
                'destination_id' => $row['destination'],
                'scheduled_load' => $row['scheduled_load'],
                'scheduled_departure' => $row['scheduled_departure'],
                'scheduled_arrival' => $row['scheduled_arrival'],
                'scheduled_unload' => $row['scheduled_unload'],

                // just filling empties
                'intermediates' => []
            ]);

//            $trip_request = app('App\Http\Requests\TripRequest'); // FormRequest


            return CreateTrip::createNewTrip($trip_request);

    }


    /**
     * @return array
     */
    public function rules(): array
    {

        $rules = (new TripRequest())->rules();
        $rules['client'] = $rules['client_id'];
        $rules['origin'] = $rules['origin_id'];
        $rules['destination'] = $rules['destination_id'];
        $rules['monitoring_type'] = $rules['mon_type'];
        $rules['carrier'] = $rules['carrier_id'];

        unset(
            $rules['client_id'],
            $rules['origin_id'],
            $rules['destination_id'],
            $rules['mon_type'],
            $rules['carrier_id']
        );
        return $rules;

//        return [
////            'rp' => 'required', // No requerido en plan de viaje, si para inicializar el viaje
////            'invoice' => 'required', // No requerido para el plan de viaje, si para inicializar el viaje
//            'client' => 'required|integer',
//
//
//            'origin' => 'required|integer',
//            'destination' => 'required|integer',
//            'monitoring_type' => 'required',
//            'carrier' => [
////                'required', // No requerido en plan de viaje, si al inicializar el viaje
//                'nullable',
//                'present',
//                'integer',
//            ],
//            'truck_tract_id' => [
////                'required', // No requerido en plan de viaje, si al inicializar el viaje
//                'nullable',
//                'integer',
//            ],
//            'operator' => [
////                'required', // No requerido en plan de viaje, si al inicializar el viaje
//                'nullable',
//                'integer',
//            ],
//            'scheduled_load' => 'required|date',
//            'scheduled_departure' => [
//                'required',
//                'date',
//                'after:scheduled_load',
//            ],
//            'scheduled_arrival' => 'required|date|after:scheduled_departure',
//            'scheduled_unload' => 'required|date|after:scheduled_arrival',
//            'trailers_ids' => [
//                'array',
//                'nullable'
//            ]
//        ];
    }
}
