<?php

namespace Tests\Feature;

use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Notifications\DynamicNotification;
use App\Notifications\WialonWebhookNotification;
use App\NotificationTrigger;
use App\User;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\Tenants\TestCase;

class NotificationsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);
        $this->be(factory(User::class)->create(), "api");


    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_activador_de_notification()
    {
//        $wialon_object = \Punksolid\Wialon\Notification::all()->first();
//        dd($wialon_object);
//        'name',
//        'resource', // automatico
//        'control_type_obj',
//        'units', // devices relationship
//        'active' //bool


        $form = [
            "name" => $this->faker->name,
            "control_type" => "panic_button",
            "units" => [
                "17471332"
            ],
            "active" => 1
        ];

        $call = $this->postJson("api/v1/notification_triggers", $form);

        $call->dump();
        $call->assertJson([
            "data" => [
                "alias" => $form["alias"],
                "deactivation_mode" => $form["deactivation_mode"]
            ]
        ]);


    }

    public function test_ping_notificacion()
    {
        Notification::fake();

        $notification_type = factory(NotificationTrigger::class)->create(["level" => "danger"]);

        $call = $this->getJson("api/v1/notification_activate/$notification_type->id");

        $call->assertStatus(200);

        Notification::assertSentTo(
            [$this->user], DynamicNotification::class
        );
    }

    public function test_desactivar_notificacion()
    {
        $notification_type = factory(NotificationTrigger::class)->create();


        $call = $this->putJson("api/v1/notification_types/$notification_type->id", [
            "active" => "false"
        ]);

        $call->assertJson([
            "active" => "false"
        ]);
        $call->assertStatus(200);
    }

    public function test_crear_geocerca()
    {
        $this->withoutExceptionHandling();
        $geofence_name = $this->faker->name;
        $lat = $this->faker->latitude;
        $lon = $this->faker->longitude;
        $radius = $this->faker->numberBetween(800, 1600);

        $call = $this->postJson("api/v1/geofences", [
            'name' => $geofence_name,
            'lat' => $lat,
            'lon' => $lon,
            'radius' => $radius
        ]);

        $call->assertJsonFragment([
            'name' => $geofence_name
        ]);
    }


    public function test_get_wialon_notifications()
    {
        $call = $this->getJson("api/v1/wialon/notifications");

        $call->assertSuccessful();
        $call->assertJsonFragment([
            "data"
        ]);
    }

    public function test_destroy_wialon_notification()
    {
        $notification = \Punksolid\Wialon\Notification::all()->first();
        $call = $this->deleteJson("api/v1/wialon/notifications/$notification->id");

        $call->assertSuccessful();
    }

    public function test_get_wialon_alert_webhook()
    {
        Notification::fake();


        $callback = [
            "unit" => "ITM 2412 TRM",
            "timestamp" => "2019-04-18 03:32:23",
            "location" => "Manuel Gómez Morín 6372, Pueblo Toluquilla, Tlaquepaque, Jalisco 45610, Mexico",
            "last_location" => "Manuel Gómez Morín 6372, Pueblo Toluquilla, Tlaquepaque, Jalisco 45610, Mexico",
            "locator_link" => "http://sh-loc.com/rcRj",
            "smallest_geofence_inside" => "GDL02",
            "all_geofences_inside" => "GDL02, trm_02",
            "UNIT_GROUP" => "Certificacion",
            "SPEED" => "0 km/h",
            "POS_TIME" => "2019-04-18 03:32:06",
            "MSG_TIME" => "2019-04-18 03:32:06",
            "DRIVER" => "%DRIVER%",
            "DRIVER_PHONE" => "%DRIVER_PHONE%",
            "TRAILER" => "%TRAILER%",
            "SENSOR" => "IGNICIÓN: Deactivated, KM GPS: 111839787.00 km, BOTÓN DE PÁNICO: Desactivado, CORTINA: Cerrada, BATERÍA:: 12.78 V, CHAPA: Abierta, BOTÓN DE AYUDA: Desactivado",
            "ENGINE_HOURS" => "17519:53:42",
            "MILEAGE" => "720137 km",
            "LAT" => "N 20° 34.6897'",
            "LON" => "W 103° 21.7663'",
            "LATD" => "20.578162",
            "LOND" => "-103.362772",
            "GOOGLE_LINK" => "http://maps.google.com/?q=20.578162,-103.362772",
            "CUSTOM_FIELD" => "ALTA EN WIALON: 11/03/2019, CELULAR: +526683963652, GPS: Ruptela FM Tco4, PLACAS: JV-57-700, UNIDAD: Tractocamión",
            "UNIT_ID" => "18921279",
            "MSG_TIME_INT" => "1555547526",
            "NOTIFICATION" => "Exceso de Velocidad",
            "X-Tenant-Id" => $this->account->uuid
        ];

        $call = $this->postJson("api/v1/webhook/alert", $callback);

        Notification::assertSentTo(
            [$this->account], WialonWebhookNotification::class
        );

        $call->assertSuccessful();
    }

    public function test_crear_notificacion_wialon()
    {
        $units_id = [
            "17471332"
        ];

        $call = $this->postJson("api/v1/wialon/notifications", [
            "name" => $this->faker->name,
            "control_type" => "panic_button",
            "units" => $units_id
        ]);

        $call->assertSuccessful();
        $call->assertJsonFragment([
            "data"
        ]);
    }

    public function test_activate_maximum_alert_notification()
    {
        $this->withoutExceptionHandling();
//        Notification::fake();

        $callback = [
            "unit" => "ITM 2412 TRM",
            "timestamp" => "2019-04-18 03:32:23",
            "location" => "Manuel Gómez Morín 6372, Pueblo Toluquilla, Tlaquepaque, Jalisco 45610, Mexico",
            "last_location" => "Manuel Gómez Morín 6372, Pueblo Toluquilla, Tlaquepaque, Jalisco 45610, Mexico",
            "locator_link" => "http://sh-loc.com/rcRj",
            "smallest_geofence_inside" => "GDL02",
            "all_geofences_inside" => "GDL02, trm_02",
            "UNIT_GROUP" => "Certificacion",
            "SPEED" => "0 km/h",
            "POS_TIME" => "2019-04-18 03:32:06",
            "MSG_TIME" => "2019-04-18 03:32:06",
            "DRIVER" => "%DRIVER%",
            "DRIVER_PHONE" => "%DRIVER_PHONE%",
            "TRAILER" => "%TRAILER%",
            "SENSOR" => "IGNICIÓN: Deactivated, KM GPS: 111839787.00 km, BOTÓN DE PÁNICO: Desactivado, CORTINA: Cerrada, BATERÍA:: 12.78 V, CHAPA: Abierta, BOTÓN DE AYUDA: Desactivado",
            "ENGINE_HOURS" => "17519:53:42",
            "MILEAGE" => "720137 km",
            "LAT" => "N 20° 34.6897'",
            "LON" => "W 103° 21.7663'",
            "LATD" => "20.578162",
            "LOND" => "-103.362772",
            "GOOGLE_LINK" => "http://maps.google.com/?q=20.578162,-103.362772",
            "CUSTOM_FIELD" => "ALTA EN WIALON: 11/03/2019, CELULAR: +526683963652, GPS: Ruptela FM Tco4, PLACAS: JV-57-700, UNIDAD: Tractocamión",
            "UNIT_ID" => "18921279",
            "MSG_TIME_INT" => "1555547526",
            "NOTIFICATION" => "Exceso de Velocidad",
            "X-Tenant-Id" => $this->account->uuid
        ];

        $call = $this->postJson("api/v1/webhook/alert", $callback);
//
//        Notification::assertSentTo(
//            [$this->user], WialonWebhookNotification::class
//        );

        $call->assertSuccessful();
    }

    public function test_get_my_notifications()
    {
        $call = $this->getJson("api/v1/me/notifications");

        $call->assertJsonStructure([
            "data" => [
                "*" => [
                    "id",
                    "message",
                    "link"
                ]
            ]
        ]);
    }


}
