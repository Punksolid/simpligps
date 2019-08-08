<?php

namespace App\Exceptions;

use Exception;

class MalformedTrip extends Exception
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
        return response('Malformed Trip Exception', 500);
    }
}
