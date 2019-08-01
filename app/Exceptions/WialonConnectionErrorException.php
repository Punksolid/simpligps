<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Throwable;


class WialonConnectionErrorException extends Exception
{

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response('Wialon Connection Error',500);
    }

}