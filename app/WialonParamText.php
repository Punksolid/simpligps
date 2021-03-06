<?php

namespace App;

class WialonParamText
{
    /**
     * @var array
     */
    private $parameters = [
        'unit' => '%UNIT%',
        'timestamp' => '%CURR_TIME%',
        'location' => '%LOCATION%',
        'last_location' => '%LAST_LOCATION%',
        'locator_link' => '%LOCATOR_LINK(60,T)%',
        'smallest_geofence_inside' => '%ZONE_MIN%',
        'all_geofences_inside' => '%ZONES_ALL%',
        'UNIT_GROUP' => '%UNIT_GROUP%',
        'SPEED' => '%SPEED%',
        'POS_TIME' => '%POS_TIME%',
        'MSG_TIME' => '%MSG_TIME%',
        'DRIVER' => '%DRIVER%',
        'DRIVER_PHONE' => '%DRIVER_PHONE%',
        'TRAILER' => '%TRAILER%',
        'SENSOR' => '%SENSOR(*)%',
        'ENGINE_HOURS' => '%ENGINE_HOURS%',
        'MILEAGE' => '%MILEAGE%',
        'LAT' => '%LAT%',
        'LON' => '%LON%',
        'LATD' => '%LATD%',
        'LOND' => '%LOND%',
        'GOOGLE_LINK' => '%GOOGLE_LINK%',
        'CUSTOM_FIELD' => '%CUSTOM_FIELD(*)%',
        'UNIT_ID' => '%UNIT_ID%',
        'MSG_TIME_INT' => '%MSG_TIME_INT%',
        'NOTIFICATION' => '%NOTIFICATION%',
    ];

    public function __construct($personalized_params = null, $default_parameters = true)
    {
        if (!$default_parameters) {
            $this->parameters = [];
        }
        if ($personalized_params) {
            $this->parameters = array_merge($this->parameters, $personalized_params);
        }
    }

    /**
     * Agrega al query elementos.
     *
     * @param $key
     * @param $value
     */
    public function addParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Retorna el Query elaborado.
     *
     * @return string
     */
    public function getText(): string
    {
        return urldecode(http_build_query($this->parameters));
    }
}
