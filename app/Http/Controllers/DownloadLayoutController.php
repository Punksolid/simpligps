<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadLayoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function __invoke(Request $request)
    {

        return response()->download(storage_path() . '/app/TripsLayout.xls');
    }
}
