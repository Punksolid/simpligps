<?php

namespace App;

use App\Services\Traccar;
use App\Services\Wialon;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Javleds\Traccar\Exceptions\TraccarApiCallException;
use Javleds\Traccar\Models\Device as TraccarDevice;
use Punksolid\Wialon\Unit;
use Psr\Log\LoggerTrait;
use Psr\Log\LoggerInterface;
use App\Traits\ModelLogger;
use Spatie\Activitylog\Traits\LogsActivity;

class Device extends Model implements LoggerInterface
{
    use LoggerTrait;
    use ModelLogger;

    use UsesTenantConnection;
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name',
        'internal_number',
        'brand',
        'model',
        'gps',
        'wialon_id', // @todo Refactor, should be external_id and another field for the driver used
        'group_id',
        'reference_data',
        'bulk',
        'deviceable_id',
        'deviceable_type',
    ];
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    protected static $logOnlyDirty = true;
    protected $casts = [
        'bulk' => 'array',
        'reference_data' => 'array',
    ];

    //region Relationships

    /**
     * Relación, un dispositivo pertenece a un carrier, antes linea.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'carrier_id');
    }

    public function notificationtriggers()
    {
        return $this->belongsToMany(NotificationTrigger::class, 'notification_triggers_devices');
    }

    public function logs()
    {
        return $this->morphMany(\App\Log::class, 'loggable');
    }

    /**
     * Un truck tiene asignado un dispositivo.
     */
    public function truck()
    {
        return $this->hasOne(TruckTract::class);
    }

    public function deviceable()
    {
        return $this->morphTo('deviceable');
    }

    //endregion

    /**
     * Liga a una unidad de wialon.
     *
     * @param Unit $unit
     *
     * @return bool
     */
    public function linkUnit(Unit $unit): bool
    {
        return (bool) $this->update([
            'wialon_id' => $unit->id,
            'reference_data' => $unit,
        ]);
    }

    /**
     * Comprueba si tiene una ligacion a un dispositivo externo.
     *
     * @return bool
     */
    public function linked($verify = false): bool
    {
        if ($verify) {
            return (bool) Unit::find($this->wialon_id);
        }

        return (bool) $this->wialon_id;
    }

    public function getLocation(): array
    {
        $traccar_handler = resolve(Traccar::class);

        if ($this->wialon_id !== null && $traccar_handler->isConfigured()){
            try {

                $unique_id = $this->wialon_id;
                $traccar = TraccarDevice::find($unique_id);
                $position = $traccar_handler->getPosition($traccar->positionId);
                $positionObj = $position[0];

                return [
                    'lat' => $positionObj->latitude,
                    'lon' => $positionObj->longitude,
                ];
            } catch (\Exception $exception) {
                logger()->warning('Couldn figure traccar position', [$exception->getMessage()]);
            }

        }
        /** @var Wialon $wialon_handler */
        $wialon_handler = resolve(Wialon::class);
        if ($this->linked() && $wialon_handler->isConfigured()) {
            // TODO REFACTOR Unit Find para que use las flags con los detalles, this is a performance issue
            $unit = Unit::all()->where('id', $this->wialon_id)->first();

            return [
                'lat' => optional($unit)->lat,
                'lon' => optional($unit)->lon,
            ];
        }

        // ugly code
        return [
            'lat' => null,
            'lon' => null,
        ];
    }

    /**
     * Verifica si el dispositivo tiene conexión externa.
     *
     * @return bool
     */
    public function verifyConnection(): bool
    {
        if (is_null($this->wialon_id)) {
            return false;
        }

        return $this->linked(true);
    }

    /**
     * Register a new Unit in Wialon Service
     */
    public function createExternalDevice()
    {
        try {
            $unit = Unit::make($this->name);
            $this->update(['reference_data' => $unit]);
        } catch (\Exception $exception) {
            Log::warning('Couldn\'t create a unit in wialon', [
                'device' => $this->toArray(),
            ]);
        }
    }
}
