<?php

use Faker\Generator as Faker;

$factory->define(App\Trip::class, function (Faker $faker) {
    return[
        "rp" => $this->faker->name,
        "invoice" => $this->faker->randomNumber(5),
        "client" => $this->faker->company,
        "intermediary" => $this->faker->company,
        "origin" => $this->faker->address,
        "destination" => $this->faker->address,
        "mon_type" => $this->faker->randomNumber(1),
        "line" => $this->faker->company,

        "scheduled_load" => $this->faker->dateTime,
        "scheduled_departure" => $this->faker->dateTime,
        "scheduled_arrival" => $this->faker->dateTime,
        "scheduled_unload" => $this->faker->dateTime

    ];
});
