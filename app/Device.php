<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Punksolid\Wialon\Unit;
use Psr\Log\LoggerTrait;
use Psr\Log\LoggerInterface;
use App\Traits\ModelLogger;
use Spatie\Activitylog\Traits\LogsActivity;

class Device extends Model implements LoggerInterface
{
    use LoggerTrait, ModelLogger;
    /**
     * Detailed debug information.
     */
    private const DEBUG = 100;

    /**
     * Interesting events.
     *
     * Examples: User logs in, SQL logs.
     */
    private const INFO = 200;

    /**
     * Uncommon events.
     */
    private const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors.
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    private const WARNING = 300;

    /**
     * Runtime errors.
     */
    private const ERROR = 400;

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     */
    private const CRITICAL = 500;

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    private const ALERT = 550;

    /**
     * Urgent alert.
     */
    private const EMERGENCY = 600;

    use UsesTenantConnection, Notifiable, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'internal_number',
        'brand',
        'model',
        'gps',
        'wialon_id',
        'group_id',
        'reference_data',
        'bulk',
        'deviceable_id',
        'deviceable_type'
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
        if ($verify){
            return (bool) Unit::find($this->wialon_id);
        }

        return (bool) $this->wialon_id;
    }

    public function getLocation(): array
    {
        if ($this->linked()){
            // TODO REFACTOR Unit Find para que use las flags con los detalles, this is a performance issue
            $unit = Unit::all()->where('id',$this->wialon_id)->first();
            return [
                'lat' => optional($unit)->lat,
                'lon' => optional($unit)->lon
            ];
        }

        // ugly code
        return [
            'lat' => null,
            'lon' => null
        ];
    }

    /**
     * Verifica si el dispositivo tiene conexión externa
     * @return bool
     */
    public function verifyConnection():bool
    {
        if (empty($this->wialon_id)){
            return false;
        }

        return $this->linked(true);
    }
}
