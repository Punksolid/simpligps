<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorRequest;
use App\Http\Resources\OperatorResource;
use App\Operator;
use Illuminate\Http\Request;

/**
 * Class OperatorController
 * @package App\Http\Controllers
 * @resource Operadores
 */
class OperatorController extends Controller
{
    /**
     * Muestra listado de operadores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::paginate();

        return OperatorResource::collection($operators);
    }


    /**
     * Crea nuevo operador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperatorRequest $request)
    {
        $operator = Operator::create($request->all());

        return response($operator);
    }

    /**
     * Muestra detalles de un solo operador
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function show(Operator $operator)
    {
        return OperatorResource::make($operator);
    }



    /**
     * Actualiza operador
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function update(OperatorRequest $request, Operator $operator)
    {
        if ($operator->update($request->all())){
            return OperatorResource::make($operator);
        }

        return response([
            "message" => "Ocurrió un error al actualizar"
        ]);


    }

    /**
     * Remueve el operador de la base de datos
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operator $operator)
    {
        if ($operator->delete()){
            return response([
                "message" => "El operador ha sido eliminado con éxito."
            ]);
        }

        return response(["message" => "Ocurrió un error al eliminar el operador."]);
    }
}
