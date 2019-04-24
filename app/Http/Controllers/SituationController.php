<?php

namespace App\Http\Controllers;

use App\Http\Requests\SituationRequest;
use App\Http\Resources\SituationResource;
use App\Situation;
use Illuminate\Http\Request;

/**
 *
 * @todo Revisar si este modulo de tipo de situacion es realmente necesario, una relacion solamente para agregar una lectura
 * no parece tener mucho sentido, sobre todo si no hay otros usos para complementarlo. Sin embargo, esta en los requerimentos
 * iniciales
 *
 * Class SituationController
 * @package App\Http\Controllers
 */
class SituationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('all')){
            return SituationResource::collection(Situation::all());
        }

        $situations = Situation::paginate();

        return SituationResource::collection($situations);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SituationRequest $request)
    {
        $situation = Situation::create($request->all());

        return SituationResource::make($situation);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function update(SituationRequest $request,  $situation)
    {
        $situation = Situation::findOrFail($situation);

        $situation->update($request->all());

        return SituationResource::make($situation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Situation  $situation
     * @return \Illuminate\Http\Response
     */
    public function destroy( $situation)
    {
        $situation = Situation::findOrFail($situation);

        $situation->delete();

        return SituationResource::make($situation);
    }
}
