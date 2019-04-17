<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerBox extends Model
{
    use UsesTenantConnection,SoftDeletes;

    protected $fillable = [
      'internal_number',
      'gps',
      'plate',
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
            'order'
        ]);
    }
    #endregion
}
