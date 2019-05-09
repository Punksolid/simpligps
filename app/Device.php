<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Punksolid\Wialon\Unit;

class Device extends Model
{
    use UsesTenantConnection, Notifiable, SoftDeletes;

    protected $fillable = [
        "name",
        "plate",
        "internal_number",
        "color",
        "brand",
        "gps",
        "model",
        "wialon_id",
        "carrier_id",
        "group_id",
        "reference_data",
        "bulk"
    ];

    protected $casts = [
        "bulk" => "array",
        "reference_data" => "array"
    ];

    #region Relationships
    /**
     * Un dispositivo puede estar registrado en muchos viajes
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Relación, un dispositivo pertenece a un carrier, antes linea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class,"carrier_id");
    }

    public function notificationtriggers()
    {
        return $this->belongsToMany(NotificationTrigger::class, 'notification_triggers_devices');
    }

    public function logs()
    {
        return $this->morphMany(\App\Log::class, 'loggable');

    }
    #endregion
    /**
     * Liga a una unidad de wialon
     * @param Unit $unit
     * @return bool
     */
    public function linkUnit(Unit $unit):bool
    {
        return (bool)$this->update([
            "wialon_id" => $unit->id,
            "reference_data" => $unit
        ]);
    }

    /**
     * Comprueba si tiene una ligacion a un dispositivo externo
     * @return bool
     */
    public function linked():bool
    {
        return (bool)$this->reference_data;
    }
}
