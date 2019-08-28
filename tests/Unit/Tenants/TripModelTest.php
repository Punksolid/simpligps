<?php

namespace Tests\Unit\Tenants;


use App\Device;
use App\Place;
use App\TrailerBox;
use App\Trip;
use App\TruckTract;
use Carbon\Carbon;
use Tests\Tenants\TestCase;

/**
 * Class TripModelTest
 *
 * @group trips
 * @package Tests\Unit\Tenants
 */
class TripModelTest extends TestCase
{
    public function test_get_all_wialon_geozones()
    {
        $trip = TripModelTest::prepareTripObject();

        $trip->addIntermediate(
            factory(Place::class)->create(['geofence_ref' => '17471233_4'])->id,
            now()->toDateTimeString(),
            now()->toDateTimeString()
        );
        $trip->addIntermediate(
            factory(Place::class)->create(['geofence_ref' => '17471233_4'])->id,
            now()->toDateTimeString(),
            now()->toDateTimeString()
        );

        //geofence_ref
        $geofences_arr = $trip->getAllPlacesGeofences();
        $this->assertEquals(4, count($geofences_arr));
        $this->assertEquals('17471233_4', $geofences_arr[0]);
    }

    /**
     * @return mixed
     */
    public static function prepareTripObject(): Trip
    {
        $device = factory(Device::class)->create(
            [
                'wialon_id' => '17471332',
                'reference_data' => '{"id":17471332,"nm":"PTS003","mu":0,"cls":2,"uacl":880333094911,"response":null,"pos":{"t":1556704664,"f":1073741825,"lc":1019141776,"y":24.791895,"x":-107.404318,"c":0,"z":32,"s":0,"sc":255},"lmsg":{"t":1556742583,"f":1073741824,"tp":"ud","pos":null,"lc":0,"rt":1556742586,"p":{"is_pwr_ext":0,"pwr_int":4.03,"charging":0,"led_on":1,"report_type":"BAT"}},"sens":{"1":{"id":1,"n":"Bateria","t":"custom","d":"","m":"%","p":"battery","f":0,"c":"{\"act\":1,\"appear_in_popup\":true,\"ci\":{},\"cm\":0,\"mu\":0,\"pos\":1,\"show_time\":false,\"text_params\":0,\"timeout\":0,\"uct\":0,\"unbound_code\":\"\",\"validate_driver_unbound\":0}","vt":0,"vs":0,"tbl":[]},"2":{"id":2,"n":"ICCID","t":"custom","d":"","m":"","p":"iccid","f":0,"c":"{\"act\":1,\"appear_in_popup\":true,\"ci\":{},\"cm\":0,\"mu\":0,\"pos\":2,\"show_time\":false,\"text_params\":0,\"timeout\":0,\"uct\":0,\"unbound_code\":\"\",\"validate_driver_unbound\":0}","vt":0,"vs":0,"tbl":[]}},"sens_max":-1,"flds":{},"fldsmax":0,"lat":24.791895,"lon":-107.404318}',
            ]
        );
        $truck_tract = factory(TruckTract::class)->create();
        $truck_tract->assignDevice($device);
        $trip = factory(Trip::class)->create(
            [
                'truck_tract_id' => $truck_tract->id,
            ]
        );

        $trip->setOrigin(
            factory(Place::class)->create(['geofence_ref' => '17471233_4']),
            now()->addDays(1),
            now()->addDays(2)
        );
        $trip->setDestination(
            factory(Place::class)->create(['geofence_ref' => '17471233_4']),
            now()->addDays(4),
            now()->addDays(5)
        );


        return $trip;
    }

    public function test_active_trip_by_interval_schedules_load_and_unload()
    {
        $ongoing_trip = factory(Trip::class)->create();
        $ongoing_trip->setOrigin(
            factory(Place::class)->create(),
            Carbon::yesterday(),
            Carbon::tomorrow()
        );

        $ongoing_trip->setDestination(
            factory(Place::class)->create(),
            now()->addDays(9),
            now()->addDays(10)
        );

        $PAST_TRIP = factory(Trip::class)->create();
        $PAST_TRIP->setOrigin(factory(Place::class)->create(), now()->subWeeks(10), now()->subWeeks(9));
        $PAST_TRIP->setDestination(factory(Place::class)->create(), now()->subWeeks(8), now()->subWeeks(7));

        $trips_search = Trip::onlyOngoing()->get();

        $this->assertTrue($trips_search->contains($ongoing_trip));
        $this->assertFalse($trips_search->contains($PAST_TRIP));

    }

    public function test_setDestination_method()
    {
        $trip = factory(Trip::class)->create();
        $arrays = $trip->setDestination($place = factory(Place::class)->create(), now(), now());

        $this->assertDatabaseHas(
            'places_trips',
            [
                'trip_id' => $trip->id,
                'place_id' => $place->id,
                'type' => 'destination',
            ],
            'tenant'
        );
    }

    public function test_getDevices_returns_devices_for_trucks_and_trailers()
    {
        $trip = TripModelTest::prepareTripObject();
        $trailer = factory(TrailerBox::class)->create();
        $device = factory(Device::class)->create(['wialon_id' => '17471332']);
        $trailer->assignDevice($device);

        $trip->addTrailerBox($trailer->id);

        $devices = $trip->getDevices();

        $this->assertInstanceOf(Device::class, $devices->first());

    }

    public function test_trip_model_changes_creates_logs()
    {
        $trip = factory(Trip::class)->create();

        $this->assertNotNull($trip->activities);
    }

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        config(["services.wialon.token" => "11b6e71f234078f1ca9e6944705a235bB6C1D1F551E3E263783A2354A63236306018E83E"]);
    }
    

    public function test_cant_update_trip_origin_if_already_set()
    {
        $trip = factory(Trip::class)->create();
        $place = factory(Place::class)->create();
        $trip->setOrigin($place, now(), now());

        $trip = $trip->fresh();

        $this->assertEquals($trip->getOrigin()->name,$place->name);
        $update_place = factory(Place::class)->create();
        $trip->setOrigin($update_place, now(), now(),now(),now());
        
        $this->assertEquals($update_place->name,$trip->getOrigin()->name);

        $third_place = factory(Place::class)->create();
        $trip->setOrigin($third_place, now(), now());

        $this->assertEquals($update_place->name,$trip->getOrigin()->name);
        
    }

    public function test_cant_update_trip_destination_if_already_set()
    {
        $trip = factory(Trip::class)->create();
        $place = factory(Place::class)->create();
        $trip->setDestination($place, now(), now());
        $trip = $trip->fresh();

        $this->assertEquals($place->name, $trip->getDestination()->name);


        $update_place = factory(Place::class)->create();
        $trip->setDestination($update_place, now(), now(),now(),now());
        
        $this->assertEquals($update_place->name,$trip->fresh()->getDestination()->name);

        $third_place = factory(Place::class)->create();
        $trip->setDestination($third_place, now(), now());
        
        $this->assertEquals($update_place->name,$trip->getDestination()->name);
    }

    public function test_cant_update_intermediates_if_real_at_time_set()
    {
        $trip = factory(Trip::class)->create();
        $place1 = factory(Place::class)->create();
        $place2 = factory(Place::class)->create();
        $trip = $trip->fresh();

        $trip->syncIntermediates([
            [
                'place_id' => $place1->id, 
                'at_time' => now()->toDateTimeString(),
                'exiting' => now()->toDateTimeString()
            ], 
            [   
                'place_id' => $place2->id,
                'at_time' => now()->toDateTimeString(),
                'exiting' => now()->toDateTimeString()
            ]
        ]);
        $this->assertEquals($place1->name,$trip->fresh()->intermediates->first()->name);
        $this->assertEquals($place2->name,$trip->fresh()->intermediates->last()->name);
            
        $place3 = factory(Place::class)->create();
        $place4 = factory(Place::class)->create();
        $trip->syncIntermediates([
             [
                'place_id' => $place3->id,
                'at_time' => now(),
                'exiting' => now(),
                'real_at_time' => now(),
                'real_exiting' => now()
            ], [
                'place_id' => $place4->id,
                'at_time' => now(),
                'exiting' => now(),
                'real_at_time' => now(),
                'real_exiting' => now()
            ]
        ]);
        $this->assertEquals($place3->name,$trip->fresh()->intermediates->first()->name);
        $this->assertEquals($place4->name,$trip->fresh()->intermediates->last()->name);

        $place5 = factory(Place::class)->create();
        $place6 = factory(Place::class)->create();
        $trip->syncIntermediates([
              [
                'place_id' => $place5->id,
                'at_time' => now(),
                'exiting' => now(),
                'real_at_time' => now(),
                'real_exiting' => now()
            ],  [
                'place_id'=> $place6->id,
                'at_time' => now(),
                'exiting' => now(),
                'real_at_time' => now(),
                'real_exiting' => now()
            ]
        ]);
        /**
         * Verificamos que 3 y 4 sean los mismos por que ya tienen fechas reales
         */
        $this->assertEquals($place3->name,$trip->fresh()->intermediates[0]->name);
        $this->assertEquals($place4->name,$trip->fresh()->intermediates[1]->name);

    }
}
