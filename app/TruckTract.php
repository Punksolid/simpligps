<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class TruckTract extends Model
{
    use UsesTenantConnection;

    protected $fillable = [
        'plate',
        'model',
        'internal_number',
        'brand',
        'gps',
        'color'
    ];

    #region Relationships
    /**
     * Belongs to, un camion solo puede tener un operador a la vez
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
    #endregion

}
