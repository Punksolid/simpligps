<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * @OA\Info(title="My First API", version="0.1")
 *
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 * @resource Dashboard
 */
class DashboardController extends Controller
{

    /**
     *      * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/sysadminv1/dashboard/accounts",
     *       @OA\Response(
     *         response=200,
     *         description="Numero de cuentas instaladas",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(type="string"),
     *         ),
     *     )
     * )
     */
    public function accounts()
    {
        return response()->json([
            'data' => Account::count()
        ]);
    }



}
