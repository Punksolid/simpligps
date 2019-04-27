<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Punksolid\Wialon\ControlType;
use Punksolid\Wialon\GeofenceControlType;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;

class NotificationTrigger extends Model
{
    use UsesTenantConnection, SoftDeletes;


    protected $fillable = [
        "name",
        "level",
        'control_type_obj',
        'audit_obj',
        "active",
    ];

    protected $casts = [
        "active" => "bool",
        "audit_obj" => "array",
        "control_type_obj" => "array",
    ];

    #region Relationships
    public function devices()
    {
        return $this->belongsToMany(
            Device::class,
            'notification_triggers_devices',
            'notification_trigger_id',
            'device_id'
        );
    }
    #endregion

    #region ExtraMethods
    /**
     * @param Device $device
     * @return bool
     */
    public function addDevice(Device $device): void
    {
        $this->devices()->attach($device->id);
    }

    public function hasDevices():bool
    {
        return $this->devices()->exists();
    }

    public function prepareUnitsColectionFromDevices()
    {
        $units = collect();
        foreach ($this->devices as $device){
            if ($device->reference_data){
                $units->push(new Unit($device->reference_data));
            }
        }
        return $units;
    }

    public function createExternalNotification($control_type, $params = null)
    {

        $tenant_uuid = config('database.connections.tenant.database');

        $resource = Resource::findByName('trm_notifications.'.$tenant_uuid);

        if (!$resource) {

            $resource = Resource::make('trm_notifications.'.$tenant_uuid);

        };

        if ($control_type == 'geofence') {
            $control_type = new GeofenceControlType();
            $control_type->addGeozoneId($params['geofence_id']);
        } else {
            $control_type = new ControlType($control_type, $params);
        }

        if (!$this->hasDevices()){
            throw new \Exception('No hay dispositivos');
        }

//        $units = Unit::findMany($request->units); // Devuelve Colleccion de objetos Unit de Punksolid/Wialon/Unit
        $units = $this->prepareUnitsColectionFromDevices(); // @todo Como esto es especifico de wialon, debe ser desacoplado de esta clase
        $action = new Notification\Action('push_messages', [
            "url" => url(config("app.url") . 'api/v1/webhook/alert')
        ]);

        $text = '"unit=%UNIT%&
        timestamp=%CURR_TIME%&
        location=%LOCATION%&
        last_location=%LAST_LOCATION%&
        locator_link=%LOCATOR_LINK(60,T)%&
        smallest_geofence_inside=%ZONE_MIN%&
        all_geofences_inside=%ZONES_ALL%&
        UNIT_GROUP=%UNIT_GROUP%&
        SPEED=%SPEED%&
        POS_TIME=%POS_TIME%&
        MSG_TIME=%MSG_TIME%&
        DRIVER=%DRIVER%&
        DRIVER_PHONE=%DRIVER_PHONE%&
        TRAILER=%TRAILER%&
        SENSOR=%SENSOR(*)%&
        ENGINE_HOURS=%ENGINE_HOURS%&
        MILEAGE=%MILEAGE%&
        LAT=%LAT%&
        LON=%LON%&
        LATD=%LATD%&
        LOND=%LOND%&
        GOOGLE_LINK=%GOOGLE_LINK%&
        CUSTOM_FIELD=%CUSTOM_FIELD(*)%&
        UNIT_ID=%UNIT_ID%&
        MSG_TIME_INT=%MSG_TIME_INT%&
        NOTIFICATION=%NOTIFICATION%&
        X-Tenant-Id=' . $tenant_uuid . '
        "';

        $text = str_replace(["\r", "\n", " "], "", $text);


        $notification = Notification::make($resource, $units, $control_type, $this->name, $action, [
            "txt" => $text
        ]);
        $this->control_type_obj = $control_type;
        $this->wialon_id = "{$resource->id}_{$notification->id}";
        $this->audit_obj = $notification;

        $this->save();

        return $notification;
    }
    #endregion
}
