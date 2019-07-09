<?php

namespace Tests\Unit\Tenants;


use App\Carrier;
use App\Device;
use App\Operator;
use App\Place;
use App\TrailerBox;
use App\Trip;
use App\TruckTract;
use Carbon\Carbon;
use Punksolid\Wialon\Notification;
use Tests\Tenants\TestCase;

class TripModelTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        config(["services.wialon.token" => "11b6e71f234078f1ca9e6944705a235bB6C1D1F551E3E263783A2354A63236306018E83E"] );
    }


    public function test_get_all_wialon_geozones()
    {
        $trip = $this->prepareTripObject();

        $trip->addIntermediate(factory(Place::class)->create(['geofence_ref' => '17471233_4'])->id, now()->toDateTimeString(), now()->toDateTimeString());
        $trip->addIntermediate(factory(Place::class)->create(['geofence_ref' => '17471233_4'])->id, now()->toDateTimeString(), now()->toDateTimeString());

        //geofence_ref
        $geofences_arr = $trip->getAllPlacesGeofences();
        $this->assertEquals(4, count($geofences_arr));
        $this->assertEquals('17471233_4', $geofences_arr[0]);
    }

    public function test_get_wialon_devices()
    {
//        trip > truck > device.wialon_ref
        $trip = $this->prepareTripObject();

        $wialon_ids = $trip->getExternalUnitsIds()->toArray();
        $this->assertIsArray($wialon_ids);
        $this->assertEquals("17471332", $wialon_ids[0]);
    }

    public function test_create_wialon_external_notifications()
    {
        $trip = $this->prepareTripObject();

        $notifications_wialon_ids = $trip->createWialonNotificationsForTrips();

        $this->assertIsArray($notifications_wialon_ids);
        $this->assertIsObject(Notification::findByUniqueId($notifications_wialon_ids[0]));

    }

    /**
     * @return mixed
     */
    public function prepareTripObject(): Trip
    {
        $trip = factory(Trip::class)->create([
            "origin_id" => factory(Place::class)->create(['geofence_ref' => '17471233_4'])->id,
            "destination_id" => factory(Place::class)->create(['geofence_ref' => '17471233_4'])->id,
            'truck_tract_id' => factory(TruckTract::class)->create([
                'device_id' => factory(Device::class)->create([
                    'wialon_id' => '17471332',
                    'reference_data' => '{"id":17471332,"nm":"PTS003","mu":0,"cls":2,"uacl":880333094911,"response":null,"pos":{"t":1556704664,"f":1073741825,"lc":1019141776,"y":24.791895,"x":-107.404318,"c":0,"z":32,"s":0,"sc":255},"lmsg":{"t":1556742583,"f":1073741824,"tp":"ud","pos":null,"lc":0,"rt":1556742586,"p":{"is_pwr_ext":0,"pwr_int":4.03,"charging":0,"led_on":1,"report_type":"BAT"}},"sens":{"1":{"id":1,"n":"Bateria","t":"custom","d":"","m":"%","p":"battery","f":0,"c":"{\"act\":1,\"appear_in_popup\":true,\"ci\":{},\"cm\":0,\"mu\":0,\"pos\":1,\"show_time\":false,\"text_params\":0,\"timeout\":0,\"uct\":0,\"unbound_code\":\"\",\"validate_driver_unbound\":0}","vt":0,"vs":0,"tbl":[]},"2":{"id":2,"n":"ICCID","t":"custom","d":"","m":"","p":"iccid","f":0,"c":"{\"act\":1,\"appear_in_popup\":true,\"ci\":{},\"cm\":0,\"mu\":0,\"pos\":2,\"show_time\":false,\"text_params\":0,\"timeout\":0,\"uct\":0,\"unbound_code\":\"\",\"validate_driver_unbound\":0}","vt":0,"vs":0,"tbl":[]}},"sens_max":-1,"flds":{},"fldsmax":0,"lat":24.791895,"lon":-107.404318}'
                ])
            ])
        ]);


        return $trip;
    }

    public function test_active_trip_by_interval_schedules_load_and_unload()
    {
        $ongoing_trip = factory(Trip::class)->create([
            'scheduled_load' => Carbon::yesterday(),
            'scheduled_unload' => Carbon::tomorrow()
        ]);
        $not_ongoing_trip = factory(Trip::class)->create([
            'scheduled_load' => Carbon::now()->subWeek(1),
            'scheduled_unload' => Carbon::yesterday()
        ]);

        $trips_search = Trip::onlyOngoing()->get();

        $this->assertTrue($trips_search->contains($ongoing_trip));
        $this->assertFalse($trips_search->contains($not_ongoing_trip));
        
    }
}
