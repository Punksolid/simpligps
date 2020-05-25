<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface LoginControllerInterface
{
    /**
     * Gives access by retrieving the Bearer Token aka Login.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/v1/login",
     *     @OA\Parameter(
     *          name="email",
     *          in="query"
     *      ),
     *     @OA\Parameter(
     *          name="password",
     *          in="query"
     *      ),
     *     @OA\Parameter(
     *          name="remember_me",
     *          in="query",
     *      ),
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
    public function login(Request $request);


    public function logout(Request $request);
}