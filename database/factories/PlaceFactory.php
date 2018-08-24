<?php

use Faker\Generator as Faker;

$factory->define(App\Place::class, function (Faker $faker) {
    return [
        "name" => $this->faker->name,
        "person_in_charge" => $this->faker->name,
        "address" => $this->faker->address,
        "phone" => $this->faker->phoneNumber
    ];
});
