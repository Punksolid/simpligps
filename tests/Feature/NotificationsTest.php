<?php

namespace Tests\Feature;

use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Notifications\DynamicNotification;
use App\NotificationType;
use App\User;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user,"api");

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_tipo_de_notification()
    {
        $tipo_de_notificacion = [
            "alias" => $this->faker->word.$this->faker->unique()->word,
            "deactivation_mode" => "implicit"
        ];

        $call = $this->postJson("api/v1/notification_types",$tipo_de_notificacion);

        $call->assertJson([
            "data" => [
                "alias" => $tipo_de_notificacion["alias"],
                "deactivation_mode" => $tipo_de_notificacion["deactivation_mode"]
            ]
        ]);


    }

    public function test_ping_notificacion()
    {
        Notification::fake();

        $notification_type = factory(NotificationType::class)->create(["level" => "danger"]);

        $call = $this->getJson("api/v1/notification_activate/$notification_type->id");

        $call->assertStatus(200);

        Notification::assertSentTo(
            [$this->user], DynamicNotification::class
        );
    }

    public function test_desactivar_notificacion()
    {
        $notification_type = factory(NotificationType::class)->create();


        $call = $this->putJson("api/v1/notification_types/$notification_type->id",[
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
        $radius = $this->faker->numberBetween(800,1600);

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


    public function test_crear_wialon_notifications()
    {
        $call = $this->postJson("api/v1/wialon/notifications",[
            "name" => $this->faker->name
            ]);

        $call->assertSuccessful();
        $call->assertJsonFragment([
            "data"
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

    public function test_get_wialon_alert_webhook()
    {
        Notification::fake();

        $metadata = [
            'key_bla' => 'value_bla'
        ];
        $call = $this->getJson("api/v1/webhook/alert", $metadata);

        Notification::assertSentTo(
            [$this->user], DynamicNotification::class
        );

        $call->assertSuccessful();
    }


}
