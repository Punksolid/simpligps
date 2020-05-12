<?php

namespace Tests\Unit;

use App\Device;
use App\Http\Middleware\SetWialonTokenMiddleware;
use App\Place;
use App\Timeline;
use App\TrailerBox;
use App\Trip;
use App\Wialon;
use App\WialonParamText;
use App\WialonTrips;
use Illuminate\Validation\ValidationException;
use Psy\Util\Str;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Tests\Tenants\TestCase;
use Tests\Unit\Tenants\TripModelTest;

/**
 * Class WialonTripTest
 *
 * @group trips
 * @package Tests\Unit
 */
class WialonTripTest extends TestCase
{
    /**
     * @var Trip
     */
    public $trip;

    public function test_create_wialon_notification_without_trailer_boxes()
    {

        $checkpoints = factory(Timeline::class,2)->create();
        $wialon_trips = new WialonTrips(
            $checkpoints->first()->trip,
            factory(Device::class)->state('in_truck')->create(),
            $checkpoints
        );

        $notifications_wialon_ids = $wialon_trips->createNotificationsForTrips();
        $this->assertIsArray($notifications_wialon_ids);
        $this->assertIsObject(Notification::findByUniqueId($notifications_wialon_ids[0]));
    }

    public function test_validateWialonReferrals()
    {
        $trip = $this->trip->fresh('places');
        $wialon_trips = new WialonTrips($trip);
        $this->assertNull($wialon_trips->validateReferrals());

    }

    public function test_create_wialon_external_notifications(): void
    {
        $wialon_trips = new WialonTrips($this->trip);
        $notifications_wialon_ids = $wialon_trips->createNotificationsForTrips();

        $this->assertIsArray($notifications_wialon_ids);
        $this->assertIsObject(Notification::findByUniqueId($notifications_wialon_ids[0]));

    }

    public function test_getParamsText_accepts_optional_fields(): void
    {

        $text = new Notification\WialonText();
        $this->assertStringNotContainsString("&place_id=", $text->getText());
        $text->addParameter('place_id' , 222);
        $text->addParameter('timeline_id' , 111);
        $text = $text->getText();

        $this->assertStringContainsString("&place_id=222", $text);
        $this->assertStringContainsString("&timeline_id=111", $text);

    }

    public function test_validateReferrals_throws_if_a_truck_orTrailer_doesnt_have_a_device(): void
    {
        $this->expectException(ValidationException::class);

        $trailer = factory(TrailerBox::class)->create();
        $this->trip->addTrailerBox($trailer->id);
        $wialon_trips = new WialonTrips($this->trip);
        $wialon_trips->validateReferrals();

    }

    public function test_trip_deactivateNotifications_should_delete_wialon_notifications()
    {

        $wialon_trips_handler = new WialonTrips($this->trip, factory(Device::class)->state('in_truck')->create());

        $notifications_wialon_ids = $wialon_trips_handler->createNotificationsForTrips();

        $this->assertTrue($wialon_trips_handler->deleteNotifications());
        $this->assertNull(Notification::findByUniqueId($notifications_wialon_ids[0]));
    }

    public function test_trip_deactivateNotifications_assert_false_when_doesnt_have_notifications_outside_the_system()
    {
        $trip = factory(Trip::class)->create();
        $wialon_trip = new WialonTrips($trip);
        $this->assertFalse($wialon_trip->deleteNotifications());
    }

    public function test_wialonText_encodes_as_wialon_asks()
    {
        $text = new WialonParamText();
        $this->assertStringContainsString("timestamp=%CURR_TIME%", $text->getText());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware([SetWialonTokenMiddleware::class]);
        config(["services.wialon.token" => env("WIALON_SECRET")]);

        $this->trip = TripModelTest::prepareTripObject();
    }

    public function test_getUnitIdOfTruck()
    {
        $trip = TripModelTest::prepareTripObject();

        $wialon_trip = new WialonTrips($trip);

        $this->assertEquals('17471332', $wialon_trip->device->wialon_id);
    }

//    public function test_borrar_todos_los_resources_de_cada_trip()
//    {
//
//        $resources = Resource::all();
//
//        $filtered = $resources->filter(function ($resource) {
//
//           return \Illuminate\Support\Str::contains($resource->nm,'6149');
//        });
//        foreach ($filtered as $resource) {
//            dump($resource->nm);
//            $resource->destroy();
//        }
//
//    }
}
