<?php

namespace App;

use App\Traits\Deviceable;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerBox extends Model
{
    use UsesTenantConnection,SoftDeletes, Deviceable;

    protected $fillable = [
        'internal_number',
        'plate'
    ];

    #region Relationships
    public function trips()
    {
        return $this->belongsToMany(
            'App\Trip',
            'trailer_boxes_trips',
            'trip_id',
            'trailer_box_id'
        )->withPivot([
            'order',
        ]);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    #endregion
}
