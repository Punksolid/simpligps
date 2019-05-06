<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorRequest;
use App\Http\Resources\OperatorResource;
use App\Operator;
use Illuminate\Http\Request;
use App\Interfaces\SearchInterface;

/**
 * Class OperatorController
 * @package App\Http\Controllers
 * @resource Operadores
 */
class OperatorsController extends Controller implements SearchInterface
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
        $operator->carrier_id = $request->carrier_id;
        $operator->save();
        return response($operator);
    }

    /**
     * Muestra detalles de un solo operador
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function show($operator)
    {
        $operator = Operator::findOrFail($operator);

        return OperatorResource::make($operator->load("carrier"));
    }



    /**
     * Actualiza operador
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function update(OperatorRequest $request,  $operator)
    {
        $operator = Operator::findOrFail($operator);

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
    public function destroy( $operator)
    {
        $operator = Operator::findOrFail($operator);
        if ($operator->delete()){
            return response([
                "message" => "The Operator was deleted succesfully."
            ]);
        }

        return response(["message" => "Ocurrió un error al eliminar el operador."])->setStatusCode(422);
    }

    public function search(\Illuminate\Http\Request $request)
    {
        
        $operators = Operator::query()
            ->where('name', 'LIKE', "%{$request->name}%")
            ->paginate(50); // Todo change for simple paginate
            

        return OperatorResource::collection($operators);
    }
}
