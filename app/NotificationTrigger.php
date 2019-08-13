<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use Punksolid\Wialon\ControlType;
use Punksolid\Wialon\GeofenceControlType;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\SensorControlType;
use Punksolid\Wialon\Unit;
use Punksolid\Wialon\WialonErrorException;

class NotificationTrigger extends Model
{
    use UsesTenantConnection;
    use SoftDeletes;

    /**
     * lista de level
     *   'emergency'
     *   'alert'
     *   'critical'
     *   'error'
     *   'warning'
     *   'notice'
     *   'info'
     *   'debug'.
     */
    protected $fillable = [
        'name',
        'level',
        'control_type',
        'audit_obj',
        'active',
    ];

    protected $guarded = [
        'wialon_id', // id wialon con formato resourceId_Localid
        'control_type_obj',
    ];

    protected $casts = [
        'active' => 'bool',
        'audit_obj' => 'array',
        'control_type_obj' => 'array',
    ];

    //region Relationships
    public function devices()
    {
        return $this->belongsToMany(
            Device::class,
            'notification_triggers_devices',
            'notification_trigger_id',
            'device_id'
        );
    }

    //endregion

    //region ExtraMethods
    public function deactivate()
    {
        $this->update(['active' => false]);
    }

    public function activate()
    {
        $this->update(['active' => true]);
    }

    /**
     * @param Device $device
     *
     * @return bool
     */
    public function addDevice(Device $device): void
    {
        $this->devices()->attach($device->id);
    }

    public function hasDevices(): bool
    {
        return $this->devices()->exists();
    }

    public function prepareUnitsColectionFromDevices()
    {
        $units = collect();
        foreach ($this->devices as $device) {
            if ($device->reference_data) {
                $units->push(new Unit($device->reference_data));
            }
        }

        return $units;
    }

    public function createExternalNotification($control_type, $params = null)
    {
        // Se identifica conexión para luego tomar los settings y el wialon token

        $tenant_uuid = config('database.connections.tenant.database');
//        Log::info("WialonTokenCheck", config('services.wialon.token')); // cuando es asincrono el config todavia no se ha cargado para este punto

        $wialon_token = (new Setting())->getWialonToken();
        config(['services.wialon.token' => $wialon_token]);
        Log::info('WialonTokenSet', [config('services.wialon.token')]); // cuando es asincrono el config todavia no se ha cargado para este punto
        // $tenant_uuid = str_replace(' ', '-', $tenant_uuid); // Replaces all spaces with hyphens.

        // try {
        // $tenant_uuid = str_replace("-","", $tenant_uuid);
        $resource = Resource::findByName('trm.notify.'.$tenant_uuid);
        Log::info('Busca un resource existente', [
                'resource buscado' => $resource,
            ]);
        if (!$resource) {
            Log::warning('Alerta:intenta crear Resource con el nombre', [
                    'trm.notify.'.$tenant_uuid,
                    ]);
            $resource = Resource::make('trm.notify.'.$tenant_uuid);

            Log::warning('Alerta: se supone que creó un resource nuevo', [
                    'resourece' => $resource,
                ]);
        }

        if ($control_type === 'geofence') {
            $control_type = new GeofenceControlType();
            $control_type->addGeozoneId($params['geofence_id']);
        } elseif ($control_type === 'sensor') {
            // dd($params);
                $control_type = new SensorControlType($params); // no necesita enviarse pero en un refactor quedaria listo
                /*
                 *  public $sensor_type = ""; // when empty, means "any"
                    public $sensor_name_mask = '*';
                    public $lower_bound = -1; //value_from
                    public $upper_bound = 1;   // value_to
                    public $prev_msg_diff = 0; //@Todo what does it means
                    public $merge = 1; //@Todo what does it means
                    public $type = 0; // "trigger when" for 0 = "in range" 1 = "out of range"
                 */
            if ($params['sensor_type'] === null) {
                $params['sensor_type'] = '';
            }

            $control_type->sensor_name_mask = $params['sensor_name'];
            $control_type->sensor_type = $params['sensor_type'];
            $control_type->type = $params['trigger_when'];
            $control_type->lower_bound = $params['value_from'];
            $control_type->upper_bound = $params['value_to'];
            $control_type->merge = $params['similar_sensor'];
        // dd($control_type->getTrg());
        } else {
            $control_type = new ControlType($control_type, $params);
        }

        if (!$this->hasDevices()) {
            throw new WialonErrorException('No hay dispositivos');
        }

        //        $units = Unit::findMany($request->units); // Devuelve Colleccion de objetos Unit de Punksolid/Wialon/Unit
            $units = $this->prepareUnitsColectionFromDevices(); // @TODO Como esto es especifico de wialon, debe ser desacoplado de esta clase
            $action = new Notification\Action('push_messages', [
                'url' => url(config('app.url').'api/v1/webhook/alert'),
            ]);

        $text = (new WialonParamText([
            'X-Tenant-Id' => $tenant_uuid,
            'notification_id' => $this->id,
        ]))->getText();
        $text = '"'.$text.'"';

        $notification = Notification::make(
            $resource,
            $units,
            $control_type,
            $this->name,
            $action,
            [
                'txt' => $text,
            ]
        );

        $this->control_type_obj = $control_type;
        $this->wialon_id = "{$resource->id}_{$notification->id}";
        $this->audit_obj = $notification;

        $this->save();

        return $notification;
    }

    //endregion
}
