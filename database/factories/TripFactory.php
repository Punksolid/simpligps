<?php

use App\Place;
use Faker\Generator as Faker;

$factory->define(App\Trip::class, function (Faker $faker) {
    return[
        "rp" => $this->faker->name,
        "invoice" => $this->faker->randomNumber(5),
        "client" => $this->faker->company,
        "intermediary" => $this->faker->company,
        "origin_id" => factory(Place::class)->create()->id,
        "destination_id" => factory(Place::class)->create()->id,
        "mon_type" => $this->faker->randomNumber(1),
        "carrier_id" => factory(\App\Carrier::class)->create()->id,
        "truck_tract_id" => factory(\App\TruckTract::class)->create()->id,

        "scheduled_load" => $this->faker->dateTime,
        "scheduled_departure" => $this->faker->dateTime,
        "scheduled_arrival" => $this->faker->dateTime,
        "scheduled_unload" => $this->faker->dateTime

    ];
});
