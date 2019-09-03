<?php

namespace Tests\Feature;

use App\Carrier;
use App\Client;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Operator;
use App\Place;
use App\Timeline;
use App\TrailerBox;
use App\Trip;
use App\TruckTract;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Tests\Tenants\TestCase;

/**
 * Class TripsTest.
 *
 * @group trips
 */
class TripsTest extends TestCase
{
    public $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user, 'api');
        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);
    }

    public function test_ver_listado_de_viajes()
    {
        $call = $this->getJson('api/v1/trips');
        $call->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'rp',
                    'invoice',
                    'origin_name',
                    'destination_name',
                    'client_name',
                    'truck_name',
                    'scheduled_load',
                    'scheduled_departure',
                    'scheduled_arrival',
                    'real_departure',
                    'real_arrival',
                ],
            ],
        ]);
    }

    public function test_crear_plan_de_viaje_con_datos_minimos_sin_opcionales()
    {
        $trip = [
            'client_id' => factory(Client::class)->create()->id,
            'origin_id' => factory(Place::class)->create()->id,
            'destination_id' => factory(Place::class)->create()->id,
            'georoute_ref' => $this->faker->shuffleString('alskdjzxcvnmflaskj'),
            'mon_type' => $this->faker->randomNumber(1), // tipo de monitoreo es una relacion
            'scheduled_load' => Carbon::now()->toDateString(),
            'scheduled_departure' => Carbon::now()->addDays(1)->toDateString(),
            'scheduled_arrival' => Carbon::now()->addDays(7)->toDateString(),
            'scheduled_unload' => Carbon::now()->addDays(8)->toDateString(),

            // optionals
            'rp' => '',
            'invoice' => '',
            'intermediates' => [],
            'trailers_ids' => [],
            'carrier_id' => null,
            'truck_tract_id' => null,
            'operator_id' => null,
        ];

        $call = $this->postJson('/api/v1/trips', $trip);
        $call->assertJson([
            'data' => [
                'client_id' => $trip['client_id'],
                'origin' => [
                    'id' => $trip['origin_id'],
                ],
                'destination' => [
                    'id' => $trip['destination_id'],
                ],
                'georoute_ref' => $trip['georoute_ref'],
                'mon_type' => $trip['mon_type'],
            ],
        ]);
        $call->assertSuccessful();
    }

    public function test_crear_nuevo_viaje_manual()
    {
        $this->withoutExceptionHandling();
        $mochis = factory(Place::class)->create();
        $trip = [
            'rp' => $this->faker->name,
            'invoice' => $this->faker->randomNumber(5),
            'client_id' => factory(Client::class)->create()->id,
            'intermediates' => [
                [
                    'place_id' => $mochis->id,
                    'at_time' => Carbon::now()->addDay(1)->toDateTimeString(),
                    'exiting' => Carbon::now()->addDay(2)->toDateTimeString(),
                ], [
                    'place_id' => factory(Place::class)->create()->id,
                    'at_time' => Carbon::now()->addDays(3)->toDateTimeString(),
                    'exiting' => Carbon::now()->addDays(4)->toDateTimeString(),
                ],
            ],
            'trailers_ids' => [
                factory(TrailerBox::class)->create()->id,
                factory(TrailerBox::class)->create()->id,
            ],
            'origin_id' => factory(Place::class)->create()->id,
            'destination_id' => factory(Place::class)->create()->id,
            'georoute_ref' => $this->faker->shuffleString('alskdjflaskj'),

            'mon_type' => $this->faker->randomNumber(1), // tipo de monitoreo es una relacion
            'carrier_id' => factory(Carrier::class)->create()->id,
            'truck_tract_id' => factory(TruckTract::class)->create()->id,
            'operator_id' => factory(Operator::class)->create()->id,

            'scheduled_load' => Carbon::now()->toDateString(),
            'scheduled_departure' => Carbon::now()->addDays(1)->toDateString(),
            'scheduled_arrival' => Carbon::now()->addDays(7)->toDateString(),
            'scheduled_unload' => Carbon::now()->addDays(8)->toDateString(),
        ];

        $call = $this->postJson('/api/v1/trips', $trip);
        $call->assertSuccessful();

        $call->assertJsonFragment([
            'truck_tract_id' => $trip['truck_tract_id'],
            'operator_id' => $trip['operator_id'],
            'client_id' => $trip['client_id'],
        ], 'asignar tracto a viaje');

        $call->assertJsonStructure([
            'data' => [
                'rp',
                'invoice',
                'client_id',
                'georoute_ref',
                'mon_type',
                'carrier_id',
                'truck_tract_id',
                'operator_id',

                'scheduled_load',
                'scheduled_departure',
                'scheduled_arrival',
                'scheduled_unload',
                'origin',
                'destination',

                'intermediates' => [
                    '*' => [
                        'id',
                        'name',
                        'at_time',
                        'exiting',
                    ],
                ],
            ],
        ]);
        $call->assertJsonFragment([
            'name' => $mochis->name,
        ]);
    }

    public function test_no_se_pueden_interpolar_tiempos_al_crear_trip()
    {
        $trip = factory(Trip::class)->raw([
            'scheduled_load' => now()->addDays(1)->toDateTimeString(),
            'scheduled_departure' => now()->addDays(2)->toDateTimeString(),
            'scheduled_arrival' => now()->addDays(11)->toDateTimeString(),
            'scheduled_unload' => now()->addDays(12)->toDateTimeString(),
        ]);

        $trip['intermediates'] = [
            [
                'place_id' => factory(Place::class)->create()->id,
                'at_time' => Carbon::now()->addDay(2)->toDateTimeString(),
                'exiting' => Carbon::now()->addDay(4)->toDateTimeString(),
            ], [
                'place_id' => factory(Place::class)->create()->id,
                'at_time' => Carbon::now()->addDays(5)->toDateTimeString(),
                'exiting' => Carbon::now()->addDays(9)->toDateTimeString(),
            ], [
                'place_id' => factory(Place::class)->create()->id,
                'at_time' => Carbon::now()->addDays(8)->toDateTimeString(),
                'exiting' => Carbon::now()->addDays(10)->toDateTimeString(),
            ],
        ];
        $call = $this->postJson('/api/v1/trips', $trip);
        $call->assertJsonValidationErrors('intermediates');
    }

    public function test_se_pueden_crear_viajes_sin_intermediates()
    {
        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->raw([
            'scheduled_load' => now()->addDays(1)->toDateTimeString(),
            'scheduled_departure' => now()->addDays(2)->toDateTimeString(),
            'scheduled_arrival' => now()->addDays(3)->toDateTimeString(),
            'scheduled_unload' => now()->addDays(4)->toDateTimeString(),
            'origin_id' => factory(Place::class)->create()->id,
            'destination_id' => factory(Place::class)->create()->id,
        ]);

        $trip['intermediates'] = [];

        $call = $this->postJson('/api/v1/trips', $trip);
        $call->assertSuccessful();
    }

    public function test_origen_y_destino_pueden_ser_repetidos()
    {
        $bodega_culiacan = factory(Place::class)->create();

        $trip = factory(Trip::class)->raw([
            'origin_id' => $bodega_culiacan->id,
            'destination_id' => $bodega_culiacan->id,
            'scheduled_load' => now()->addDays(1)->toDateTimeString(),
            'scheduled_departure' => now()->addDays(2)->toDateTimeString(),
            'scheduled_arrival' => now()->addDays(3)->toDateTimeString(),
            'scheduled_unload' => now()->addDays(4)->toDateTimeString(),
        ]);

        $trip['intermediates'] = [];

        $call = $this->postJson('/api/v1/trips', $trip);
        $call->assertSuccessful();
    }

    public function test_intermediates_no_pueden_repetirse()
    {
        $trip = factory(Trip::class)->raw([
            'scheduled_arrival' => Carbon::now()->addDay(11)->toDateTimeString(),
            'scheduled_unload' => Carbon::now()->addDay(12)->toDateTimeString(),
        ]);
        $culiacan = factory(Place::class)->create();
        $mochis = factory(Place::class)->create();
        $trip['intermediates'] = [
            [
                'place_id' => $culiacan->id,
                'at_time' => Carbon::now()->addDay(3)->toDateTimeString(),
                'exiting' => Carbon::now()->addDay(4)->toDateTimeString(),
            ], [
                'place_id' => $mochis->id,
                'at_time' => Carbon::now()->addDays(5)->toDateTimeString(),
                'exiting' => Carbon::now()->addDays(6)->toDateTimeString(),
            ], [
                'place_id' => $culiacan->id,
                'at_time' => Carbon::now()->addDays(9)->toDateTimeString(),
                'exiting' => Carbon::now()->addDays(10)->toDateTimeString(),
            ],
        ];

        $call = $this->postJson('/api/v1/trips', $trip);

        $call->assertSee('The intermediates.0.place_id field has a duplicate value.');
    }

    public function test_scheduled_departure_no_puede_ser_mayor_a_las_fechas_de_intermedios()
    {
        $trip = factory(Trip::class)->raw([
            'scheduled_arrival' => Carbon::now()->addDay(11)->toDateTimeString(),
            'scheduled_unload' => Carbon::now()->addDay(12)->toDateTimeString(),
            'scheduled_departure' => Carbon::now()->addDay(4)->toDateTimeString(),
        ]);
        $culiacan = factory(Place::class)->create();
        $mochis = factory(Place::class)->create();
        $trip['intermediates'] = [
            [
                'place_id' => $culiacan->id,
                'at_time' => Carbon::now()->addDay(3)->toDateTimeString(),
                'exiting' => Carbon::now()->addDay(4)->toDateTimeString(),
            ], [
                'place_id' => $mochis->id,
                'at_time' => Carbon::now()->addDays(5)->toDateTimeString(),
                'exiting' => Carbon::now()->addDays(6)->toDateTimeString(),
            ],
        ];

        $call = $this->postJson('/api/v1/trips', $trip);

        $call->assertSee('The intermediates.0.at_time must be a date after scheduled departure.');
    }

    public function test_ver_detalles_de_un_viaje()
    {
        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->create([
            'truck_tract_id' => factory(TruckTract::class)->create()->id,
            'operator_id' => factory(Operator::class)->create()->id,
            'client_id' => factory(Client::class)->create()->id,
        ]);
        $llegada_al_origen = now()->addDays(1);
        $salida_del_origen = now()->addDays(2);
        $trip->setOrigin($origen = factory(Place::class)->create(), $llegada_al_origen, $salida_del_origen);
        $llegada_al_destino = now()->addDays(1);
        $salida_del_destino = now()->addDays(2);
        $trip->setDestination($destino = factory(Place::class)->create(), $llegada_al_destino, $salida_del_destino);

        $trip->addIntermediate(
                factory(Place::class)->create()->id,
                now()->addDay(3)->toDateTimeString(),
                now()->addDay(4)->toDateTimeString()
        );

        $call = $this->getJson("api/v1/trips/{$trip->id}");
        $call->assertSuccessful();
        $call->assertJsonFragment([
            'scheduled_load' => $llegada_al_origen->toDateTimeString(),
            'scheduled_departure' => $salida_del_origen->toDateTimeString(),
            'scheduled_arrival' => $llegada_al_destino->toDateTimeString(),
            'scheduled_unload' => $salida_del_destino->toDateTimeString(),
        ]);

        $call->assertJsonStructure([
            'data' => [
                'id',
                'rp',
                'invoice',
                'client_id',

                'mon_type',
                'carrier_id',

                'scheduled_load',
                'scheduled_departure',
                'scheduled_arrival',
                'scheduled_unload',
                'origin' => [
                    'id',
                    'name',
                    'at_time',
                    'exiting',
                    'real_at_time',
                    'real_exiting',
                ],
                'destination' => [
                    'id',
                    'name',
                ],
                'intermediates' => [
                    '*' => [
                        'id',
                        'name',
                        'at_time',
                        'exiting',
                    ],
                ],
                'truck',
                'operator',
            ],
        ]);

        $call->assertJson([
            'data' => [
                'id' => $trip->id,
                'origin' => [
                    'id' => $origen->id,
                    'at_time' => $llegada_al_origen->toDateTimeString(),
                    'exiting' => $salida_del_origen->toDateTimeString(),
                ],
            ],
        ]);
    }

    public function test_usuario_puede_editar_viaje_enviando_todos_los_elementos()
    {
        $original_trip = factory(Trip::class)->create();
        $original_trip->addIntermediate($mazatlan = factory(Place::class)->create(), now(), now());

        $trip_modified = [
            'rp' => $this->faker->name,
            'invoice' => $this->faker->randomNumber(5),
            'client_id' => factory(Client::class)->create()->id,
            'intermediates' => [
                [
                    'place_id' => factory(Place::class)->create()->id,
                    'at_time' => Carbon::now()->addDay(3)->toDateTimeString(),
                    'exiting' => Carbon::now()->addDay(4)->toDateTimeString(),
                ], [
                    'place_id' => factory(Place::class)->create()->id,
                    'at_time' => Carbon::now()->addDays(5)->toDateTimeString(),
                    'exiting' => Carbon::now()->addDays(6)->toDateTimeString(),
                ],
            ],
            'origin_id' => factory(Place::class)->create()->id,
            'destination_id' => factory(Place::class)->create()->id,
            'mon_type' => $this->faker->randomNumber(1),
            'carrier_id' => factory(Carrier::class)->create()->id,
            'truck_tract_id' => factory(TruckTract::class)->create()->id,
            'operator_id' => factory(Operator::class)->create()->id,
            'trailers_ids' => [
                factory(TrailerBox::class)->create()->id,
            ],
            'scheduled_load' => Carbon::now()->toDateTimeString(),
            'scheduled_departure' => Carbon::now()->addDays(1)->toDateTimeString(),
            'scheduled_arrival' => Carbon::now()->addDays(7)->toDateTimeString(),
            'scheduled_unload' => Carbon::now()->addDays(8)->toDateTimeString(),
        ];

        $call = $this->putJson('/api/v1/trips/'.$original_trip->id, $trip_modified);

        $call->assertJson([
            'data' => [
                'rp' => $trip_modified['rp'],
                'truck_tract_id' => $trip_modified['truck_tract_id'], // puede modificar tracto
                'operator_id' => $trip_modified['operator_id'], // puede modificar operador
            ],
        ]);

        $call->assertJsonMissing([
           'id' => $mazatlan->id,
        ]);
        $call->assertJsonFragment([
             'id' => $trip_modified['trailers_ids'][0],
        ]);

        $call->assertStatus(200);

        return $call->getOriginalContent();
    }

    public function test_no_puede_editar_origen_que_ya_tiene_marcado_sus_campos_reales()
    {
        $trip = factory(Trip::class)->create();
        $original_origin = factory(Place::class)->create();
        $original_destination = factory(Place::class)->create();
        $trip->setOrigin($original_origin, now(), now(), now(), now());
        $trip->setDestination($original_destination, now(), now());
        $new_destination = factory(Place::class)->create();
        $update_form = $trip->toArray();
        $new_origin = factory(Place::class)->create();
        $update_form['origin_id'] = $new_origin->id;
        $update_form['destination_id'] = $new_destination->id;
        $update_form['scheduled_load'] = now()->addHours(1)->toDateTimeString();
        $update_form['scheduled_departure'] = now()->addDays(1)->addHours(2)->toDateTimeString();
        $update_form['scheduled_arrival'] = now()->addDays(2)->addHours(3)->toDateTimeString();
        $update_form['scheduled_unload'] = now()->addDays(3)->addHours(4)->toDateTimeString();
        $update_form['intermediates'] = [];
        $update_form['trailers_ids'] = [];

        $call = $this->putJson('api/v1/trips/'.$trip->id, $update_form);
        $call->assertJsonMissing(['name' => $new_origin->name]);
        $call->assertJsonFragment(['name' => $original_origin->name]);
        $call->assertJsonFragment(['name' => $new_destination->name]);
    }

    public function test_no_puede_borrar_checkpoint_intermediate_que_tiene_campo_real_de_llegada()
    {
        $trip = factory(Trip::class)->create();
        $trip->setOrigin(factory(Place::class)->create(), now(), now(), now(), now());
        $trip->setDestination(factory(Place::class)->create(), now(), now(), now(), now());
        $intermediate_place = factory(Place::class)->create();
        $checkpoint = factory(Timeline::class)->create([
            'place_id' => $intermediate_place->id,
            'trip_id' => $trip->id,
            'type' => 'intermediate',
            'real_at_time' => now(),
        ]);
        $update_form = $trip->toArray();
        $new_destination = factory(Place::class)->create();
        $update_form['origin_id'] = $new_origin = factory(Place::class)->create()->id;
        $update_form['destination_id'] = $new_destination->id;
        $update_form['scheduled_load'] = now()->addHours(1)->toDateTimeString();
        $update_form['scheduled_departure'] = now()->addDays(1)->addHours(2)->toDateTimeString();
        $update_form['scheduled_arrival'] = now()->addDays(2)->addHours(3)->toDateTimeString();
        $update_form['scheduled_unload'] = now()->addDays(3)->addHours(4)->toDateTimeString();
        $update_form['intermediates'] = [];
        $update_form['trailers_ids'] = [];

        $call = $this->putJson('api/v1/trips/'.$trip->id, $update_form);
        
        $call->assertJsonFragment(['name' => $intermediate_place->name]);
        $call->assertJsonMissing(['name' => $new_destination->name]);
    }

    public function test_tiene_dos_intermediate_uno_marcado_otro_sin_marcar_debe_borrar_el_sin_marcar()
    {
//        $this->withoutExceptionHandling();
        $trip = factory(Trip::class)->create();
        $trip->setOrigin($destination = factory(Place::class)->create(), now(), now());
        $trip->setDestination($destination = factory(Place::class)->create(), now(), now());
        $checkpoint_marcado = factory(Timeline::class)->create([
            'trip_id' => $trip->id,
            'place_id' => factory(Place::class)->create()->id,
            'real_at_time' => now(),
            'type' => 'intermediate'
        ]);

        $place2 = factory(Place::class)->create();
        $checkpoint_a_borrar = factory(Timeline::class)->create([
            'trip_id' => $trip->id,
            'place_id' => $place2->id,
            'type' => 'intermediate'
        ]);
        $this->assertDatabaseHas('places_trips', [
            'trip_id' => $trip->id,
            'place_id' => $place2->id,
            'type' => 'intermediate',
        ], 'tenant');

        $this->assertCount(2,$trip->intermediates()->get());

        $update_form = [
            'client_id' => $trip->client_id,
            'origin_id' => $destination->id,
            'destination_id' => $trip->getDestination()->id,
            'scheduled_load' => now()->toDateTimeString(),
            'scheduled_departure' => now()->addHour(1)->toDateTimeString(),
            'intermediates' => [
                [
                    'id' => $checkpoint_marcado->id,
                    'place_id' => $checkpoint_marcado->place_id,
                    'at_time' => Carbon::now()->addHour(2)->toDateTimeString(),
                    'exiting' => Carbon::now()->addHour(3)->toDateTimeString()
                ]
            ],
            'scheduled_arrival' => now()->addHour(4)->toDateTimeString(),
            'scheduled_unload' => now()->addHour(5)->toDateTimeString(),
            'mon_type' => 'askljdh',
            'carrier_id' => factory(Carrier::class)->create()->id,
            'trailers_ids' => []
        ];

        $call = $this->putJson('api/v1/trips/'.$trip->id, $update_form);
        $call->assertSuccessful();
        $call->assertJsonMissing([
           'name' => $checkpoint_a_borrar->place->name
        ]);
        $call->assertJsonFragment([
            'name' => $checkpoint_marcado->place->name
        ]);
        $this->assertCount(1,$trip->intermediates()->get());

    }

    public function test_editar_viaje_con_patch_method()
    {
        $original_trip = factory(Trip::class)->create();
        $original_trip->addIntermediate($mazatlan = factory(Place::class)->create(), now(), now());

        $trip_modified = [
            'rp' => $this->faker->name,
            'invoice' => $this->faker->randomNumber(5),
            'client_id' => factory(Client::class)->create()->id,

            'origin_id' => factory(Place::class)->create()->id,
            'destination_id' => factory(Place::class)->create()->id,
            'mon_type' => $this->faker->randomNumber(1),
            'carrier_id' => factory(Carrier::class)->create()->id,
            'truck_tract_id' => factory(TruckTract::class)->create()->id,
            'operator_id' => factory(Operator::class)->create()->id,
            'trailers_ids' => [
                factory(TrailerBox::class)->create()->id,
            ],
            'scheduled_load' => Carbon::now()->toDateTimeString(),
            'scheduled_departure' => Carbon::now()->addDays(1)->toDateTimeString(),
            'scheduled_arrival' => Carbon::now()->addDays(7)->toDateTimeString(),
            'scheduled_unload' => Carbon::now()->addDays(8)->toDateTimeString(),
        ];

        $call = $this->patchJson('/api/v1/trips/'.$original_trip->id, $trip_modified);

        $call->assertJson([
            'data' => [
                'rp' => $trip_modified['rp'],
                'truck_tract_id' => $trip_modified['truck_tract_id'], // puede modificar tracto
                'operator_id' => $trip_modified['operator_id'], // puede modificar operador
            ],
        ]);

        $call->assertJsonMissing([
            'id' => $mazatlan->id,
        ]);
        $call->assertJsonFragment([
            'id' => $trip_modified['trailers_ids'][0],
        ]);

        $call->assertStatus(200);

        return $call->getOriginalContent();
    }

    public function test_editar_las_fechas_reales_de_entrada_y_salida_a_cualquier_lugar_del_timeline()
    {
        $trip = factory(Trip::class)->create();
        $trip->setOrigin($place1 = factory(Place::class)->create(), now(), now());
        $trip->addIntermediate($place2 = factory(Place::class)->create(), now(), now());
        $trip->addIntermediate($place3 = factory(Place::class)->create(), now(), now());
        $trip->addIntermediate($place4 = factory(Place::class)->create(), now(), now());
        $trip->setDestination($place5 = factory(Place::class)->create(), now(), now());

        $checkpoint = $trip->places()->findOrFail($place1->id);
        $form = [
            'real_at_time' => now()->addDays(1)->toDateTimeString(),
            'real_exiting' => now()->addDays(1)->toDateTimeString(),
        ];

        $call = $this->patchJson("/api/v1/checkpoints/{$checkpoint->pivot->id}", $form);

        $call->assertJson([
            'data' => [
                'name' => $place1->name,
                'real_at_time' => $form['real_at_time'],
                'real_exiting' => $form['real_exiting'],
            ],
        ]);
    }

    public function test_usuario_elimina_viaje()
    {
        $this->withoutExceptionHandling();
        $trip_arr = factory(Trip::class)->create();

        $call = $this->deleteJson('/api/v1/trips/'.$trip_arr['id']);
        $call->assertSuccessful();
        $this->assertDatabaseMissing('trips', [
            'client_id' => $trip_arr['client_id'],
        ], 'tenant');
    }

    public function test_crear_importacion_de_plan_de_viaje()
    {
        $this->markTestIncomplete('agregar');
        $user = factory(User::class)->create();
        $trip = [
            'rp' => $this->faker->name,
            'invoice' => $this->faker->randomNumber(5),
            'client_id' => factory(Client::class)->create()->id,
            'intermediary' => $this->faker->company,
            'origin' => $this->faker->address,
            'destination' => $this->faker->address,
            'mon_type' => $this->faker->randomNumber(1),
            'carrier_id' => $this->faker->company,

            'scheduled_load' => Carbon::now()->toDateTimeString(),
            'scheduled_departure' => Carbon::now()->addDays(1)->toDateTimeString(),
            'scheduled_arrival' => Carbon::now()->addDays(2)->toDateTimeString(),
            'scheduled_unload' => Carbon::now()->addDays(3)->toDateTimeString(),
        ];
        $path = '/home/ps/Descargas/formatos de carga de viajes/';
        $name = 'viajes(sin opciones).xlsx';
        $file = new UploadedFile($path.$name, $name);

        $call = $this->actingAs($user)->call(
            'POST',
            '/api/v1/trips/upload',
            [],
            [],
            ['viajes' => $file],
            ['Accept' => 'application/json']
        );

        $call->assertJson($trip);
    }

    public function test_ver_viajes_activos()
    {
        $trip = factory(Trip::class)->create();
        $trip->attachTag('active');
        $call = $this
            ->actingAs(factory(User::class)->create())
            ->getJson('api/v1/trips?filter=active');

        $call->assertJsonFragment([
            'id' => $trip->id,
            'rp' => $trip->rp,
        ]);

        $call->assertStatus(200);
    }
}
