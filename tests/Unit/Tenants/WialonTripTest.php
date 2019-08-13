<?php

namespace Tests\Unit;

use App\TrailerBox;
use App\Trip;
use App\WialonTrips;
use Illuminate\Validation\ValidationException;
use Punksolid\Wialon\Notification;
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

    public function test_get_wialon_devices()
    {

        $wialon_ids = $this->trip->wialon_trips->getExternalWialonUnitsIds()->toArray();
        $this->assertIsArray($wialon_ids);
        $this->assertEquals("17471332", $wialon_ids[0]);
    }

    public function test_create_wialon_notification_without_trailer_boxes()
    {
        $notifications_wialon_ids = (new WialonTrips($this->trip))->createWialonNotificationsForTrips();

        $this->assertIsArray($notifications_wialon_ids);
        $this->assertIsObject(Notification::findByUniqueId($notifications_wialon_ids[0]));
    }

    public function test_validateWialonReferrals()
    {
        $trip = $this->trip->fresh('places');
        $this->assertNull($trip->wialon_trips->validateWialonReferrals());

    }

    public function test_create_wialon_external_notifications()
    {

        $notifications_wialon_ids = (new WialonTrips($this->trip))->createWialonNotificationsForTrips();

        $this->assertIsArray($notifications_wialon_ids);
        $this->assertIsObject(Notification::findByUniqueId($notifications_wialon_ids[0]));

    }

    public function test_getWialonParamsText_accepts_optional_fields()
    {
        $trip = factory(Trip::class)->create();

        $wialon_trips = new WialonTrips($trip);
        $text = $wialon_trips->getWialonParamsText( 10);
        $this->assertStringNotContainsString("&place_id=", $text);

        $text = $wialon_trips->getWialonParamsText(000, 222, 111);


        $this->assertStringContainsString("&place_id=222", $text);
        $this->assertStringContainsString("&timeline_id=111", $text);

    }

    public function test_validateWialonReferrals_throws_if_a_truck_orTrailer_doesnt_have_a_device()
    {
        $this->expectException(ValidationException::class);

        $trailer = factory(TrailerBox::class)->create();
        $this->trip->addTrailerBox($trailer->id);
        $wialon_trips = new WialonTrips($this->trip);
        $wialon_trips->validateWialonReferrals();

    }

    public function test_trip_deactivateNotifications_should_delete_wialon_notifications()
    {
        $wialon_trips_handler = new WialonTrips($this->trip);
        $notifications_wialon_ids = $wialon_trips_handler->createWialonNotificationsForTrips();

        $this->assertTrue($wialon_trips_handler->deleteWialonNotificationsForTrips());
        $this->assertNull(Notification::findByUniqueId($notifications_wialon_ids[0]));
    }

    public function test_trip_deactivateNotifications_assert_false_when_doesnt_have_notifications_outside_the_system()
    {
        $trip = factory(Trip::class)->create();
        $wialon_trip = new WialonTrips($trip);
        $this->assertFalse($wialon_trip->deleteWialonNotificationsForTrips());
    }

    protected function setUp(): void
    {
        parent::setUp();
        config(["services.wialon.token" => "11b6e71f234078f1ca9e6944705a235bB6C1D1F551E3E263783A2354A63236306018E83E"]);
        $this->trip = TripModelTest::prepareTripObject();
    }
}
