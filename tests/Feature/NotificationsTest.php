<?php

namespace Tests\Feature;

use App\NotificationType;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crear_tipo_de_notification()
    {
        $tipo_de_notificacion = [
            "alias" => $this->faker->word,
            "deactivation_mode" => "implicit"
        ];

        $call = $this->actingAs(factory(User::class)->create())
            ->json("POST","api/v1/notification_types",$tipo_de_notificacion);

        $call->assertJson([
            "data" => [
                "alias" => $tipo_de_notificacion["alias"],
                "deactivation_mode" => $tipo_de_notificacion["deactivation_mode"]
            ]
        ]);


    }

    public function test_ping_notificacion()
    {
        $notification_type = factory(NotificationType::class)->create(["level" => "danger"]);


        $call = $this->actingAs(factory(User::class)->create())
            ->json("GET","api/v1/notification_activate/$notification_type->id");


        $call->assertStatus(200);
    }

    public function test_desactivar_notificacion()
    {
        $notification_type = factory(NotificationType::class)->create();


        $call = $this->actingAs(factory(User::class)->create())
            ->json("PUT","api/v1/notification_types/$notification_type->id",[
                "active" => "false"
            ]);

        $call->assertJson([
            "active" => "false"
        ]);
        $call->assertStatus(200);
    }
}
