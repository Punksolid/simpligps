<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;

/**
 *
 * Class DashboardController
 * @resource Dashboard
 */
class DashboardController extends Controller
{
    /**
     * Lists .
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function accounts()
    {
        return response()->json([
            'data' => Account::count(),
        ]);
    }
}
