<?php

namespace App\Exceptions;

use Exception;

class WialonConnectionError extends Exception
{
    /**
     * Report the exception.
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response('Wialon Connection Error', 500);
    }
}
