<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;

/**
 * Class TripsController
 * @package App\Http\Controllers
 * @resource Trips
 */
class TripsController extends Controller
{
    /**
     * Lista todos los viajes sin filtros
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Trip::query()->orderByDesc("created_at");
        if ($request->has("filter")){
            $query = $query->withAnyTags($request->filter);
        }

        $trips = $query->paginate();
        return TripResource::collection($trips);

    }

    /**
     * filtra viajes por etiquetas
     * @param array $tags
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function filteredWithTags(Request $request)
    {

//        $trips_filtered = Trip::withAllTags($tags)->get(); //todo cambiar a Mariadb10.2

        $trips_filtered = Trip::where("tag", $request->tag)->get();

        return response($trips_filtered);
    }

    public function assignTag(Trip $trip, Request $request)
    {
//        $trip->attachTag($request->tag); //TODO update mariadb to 10.2 actualmente tiene 10.1
        $trip->tag = $request->tag;
        $trip->save();
        return response($trip);
    }
    /**
     * Creación de nuevo viaje
     *
     * @param  \Illuminate\Http\Request $request
     * @return TripResource|\Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $trip = Trip::make($request->except([
            'scheduled_load',
            'scheduled_departure',
            'scheduled_arrival',
            'scheduled_unload'
            ]));
        $trip->scheduled_load  = new Carbon($request->scheduled_load); // format 2019-05-25T14:35:00.000Z
        $trip->scheduled_departure = new Carbon($request->scheduled_departure);
        $trip->scheduled_arrival = new Carbon($request->scheduled_arrival);
        $trip->scheduled_unload = new Carbon($request->scheduled_unload);

        $trip->origin_id = $request->origin_id;
        $trip->destination_id = $request->destination_id;
        $trip->carrier_id = $request->carrier_id;
        $trip->truck_tract_id = $request->truck_tract_id;
        $trip->operator_id = $request->operator_id;
        $trip->client_id = $request->client_id;
        $trip->save();
        foreach ($request->intermediates as $intermediate_id) {
            $trip->addIntermediate($intermediate_id);
        }
        foreach ($request->trailers_ids as $trailers_id){
            $trip->addTrailerBox($trailers_id);
        }

        try {
            $trip->createWialonNotification();

        } catch (\Exception $exception) {
            \Log::error('Something happened when creating external notifications', $trip->toArray());
        }

        return TripResource::make($trip);
    }

    /**
     * Subir archivo excel
     *
     */
    public function upload()
    {

    }
//    public function upload(Request $request)
//    {
//        $path = $request->viajes->getRealPath();
//
//        $data = \Excel::selectSheetsByIndex(0)->load($path, function ($reader) {
//            // Format the date
//            $reader->formatDates(false);
//
//
//        })->get([
//            "rp",
//            "folio",
//            "origen",
//            "linea_transportista",
//            "cliente",
//            "tipo_de_carga",
//            "fecha_carga",
//            "hora_carga",
//            "fecha_salida_programada",
//            "hora_salida_programada",
//            "fecha_programada_cita_cliente",
//            "hora_programada_cita_cliente",
//        ]);
//
//        $trips_obj = $data->all();
//        $trips_arr = $data->toArray();
//        $validator = \Validator::make($trips_arr, [
//            "*.rp" => "required",
//            "*.folio" => "required",
//            "*.origen" => "required",
//            "*.linea_transportista" => "required",
//            "*.cliente" => "required",
//            "*.tipo_de_carga" => "required",
//            "*.fecha_carga" => "required",
//            "*.hora_carga" => "required",
//            "*.fecha_salida_programada" => "required",
//            "*.hora_salida_programada" => "required",
//            "*.fecha_programada_cita_cliente" => "required",
//            "*.hora_programada_cita_cliente" => "required",
//        ]);
//        if ($validator->fails()){
//            return response($validator->messages());
//        }
//
//        foreach ($trips_obj as $trip) {
//
//            $scheduled_load = Carbon::createFromFormat("d/m/Y H:i", "$trip->fecha_carga $trip->hora_carga");
//            $scheduled_departure = Carbon::createFromFormat("d/m/Y H:i", "$trip->fecha_salida_programada $trip->hora_salida_programada");
//            $scheduled_arrival = Carbon::createFromFormat("d/m/Y H:i", "$trip->fecha_programada_cita_cliente $trip->hora_programada_cita_cliente");
//
//            $trip_obj = new Trip([
//                "rp" => $trip->rp,
//                "invoice" => $trip->folio,
//                "client" => $trip->cliente,
//                "origin" => $trip->origen,
//                "line" => $trip->linea_transportista,
//                "mon_type" => $trip->tipo_de_carga,
//
//                "scheduled_load" => $scheduled_load,
//                "scheduled_departure" => $scheduled_departure,
//                "scheduled_arrival" => $scheduled_arrival
//            ]);
//            $trip_obj->save();
//        }
//
//        return response([
//            "succesful" => "Almacenado"
//        ]);
//
//
//    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function show($trip_id)
    {
        $trip = Trip::with([
            'origin',
            'destination',
            'intermediates',
            'device',
            'trailers',
            'tags',
            'truck',
            'operator',
            'client'
        ])->findOrFail($trip_id);

        return TripResource::make($trip);
    }

    /**
     * Editar viaje
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, $trip)
    {
        $trip = Trip::findOrFail($trip);

        $trip->origin_id = $request->origin_id;
        $trip->destination_id = $request->destination_id;
        $trip->carrier_id = $request->carrier_id;
        $trip->truck_tract_id = $request->truck_tract_id;

        foreach ($request->intermediates as $intermediate_id) {
            $trip->addIntermediate($intermediate_id);
        }
        foreach ($request->trailers_ids as $trailers_id){
            $trip->addTrailerBox($trailers_id);
        }

        $trip->update($request->all());


        return TripResource::make($trip->load('trailers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        if ($trip->delete()) {
            return response([
                "message" => "eliminado"
            ]);
        }
        return response([
            "message" => "falló al eliminar el viaje"
        ]); //todo cambiar por thwrow exception

    }
}
