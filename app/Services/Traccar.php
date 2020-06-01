<?php

namespace App\Services;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Javleds\Traccar\Exceptions\TraccarApiCallException;
use Javleds\Traccar\Facades\Client;

class Traccar
{

    public function isConfigured(): bool
    {
        if (!\config('traccar.base_url')){
            return false;
        }
        if (!\config('traccar.auth.username')){
            return false;
        }
        if (!\config('traccar.auth.password')){
            return false;
        }

        return true;
    }

    public function getPosition($position_id)
    {
        $position = Client::get('positions', [
            'id' => $position_id
        ]);

        return $position;
    }

    public function getConfigurations()
    {
        return \config('traccar');
    }
}