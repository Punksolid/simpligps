<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Logged user information
     *
     * @return \Illuminate\Http\Response
     */
    public function meInfo()
    {
        return UsersResource::make(auth()->user());
    }


}
