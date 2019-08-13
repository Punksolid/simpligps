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

}
