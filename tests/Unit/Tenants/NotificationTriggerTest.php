<?php

namespace Tests\Unit\Tenants;

use App\Device;
use App\NotificationTrigger;
use Punksolid\Wialon\Unit;
use Tests\TestCase;

class NotificationTriggerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->setWebsiteEnvironment();

    }

    public function testDevices()
    {
        $notification_trigger = factory(NotificationTrigger::class)->create();
        $device = factory(Device::class)->create();
        $notification_trigger->devices()->attach($device->id);

        $notification_trigger->devices->first();

        $this->assertEquals($device->name, $notification_trigger->devices()->first()->name);

    }
    public function testAddDevice()
    {
        $notification_trigger = factory(NotificationTrigger::class)->create();
        $device = factory(Device::class)->create();

        $notification_trigger->addDevice($device);

        $this->assertEquals($device->name, $notification_trigger->devices()->first()->name);
    }

    public function testHasDevices()
    {
        $notification_trigger = factory(NotificationTrigger::class)->create();
        $this->assertFalse($notification_trigger->hasDevices());
        $notification_trigger->addDevice(factory(Device::class)->create());

        $this->assertTrue($notification_trigger->hasDevices());
    }

    public function testCreateExternalNotification()
    {
        $device = factory(Device::class)->create();

        $unit = Unit::all()->first();
        $device->linkUnit($unit);

        $notification_trigger = factory(NotificationTrigger::class)->create();
        $notification_trigger->addDevice($device);

/*        $form = [
            "name" => $this->faker->name,
            "control_type" => "panic_button",
            "units" => [
                "17471332"
            ],
            "active" => 1
        ];*/

        $wialon_not = $notification_trigger->createExternalNotification("panic_button");

        $this->assertEquals($wialon_not->n, $notification_trigger->name);

    }
}