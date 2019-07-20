<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Este es un MODELO ESPECIAL, es un PIVOT de Trips y Places
 * Util para toda la logica que tenga que ver con Origen, Destino e Intermedios
 *
 * Class Timeline
 * @package App
 */
class Timeline extends Pivot
{
    protected $table = 'places_trips';


}
