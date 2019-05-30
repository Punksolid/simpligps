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

    use UsesTenantConnection, Notifiable, SoftDeletes;

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
    ];

    protected $casts = [
        'bulk' => 'array',
        'reference_data' => 'array',
    ];

    //region Relationships

    /**
     * Un dispositivo puede estar registrado en muchos viajes.
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

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
    public function linked(): bool
    {
        return (bool) $this->reference_data;
    }
}
