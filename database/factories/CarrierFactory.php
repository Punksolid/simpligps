<?php

use Faker\Generator as Faker;

$factory->define(App\Carrier::class, function (Faker $faker) {
    return [
        "carrier_name" => $faker->company,
        "contact_name" => $faker->name,
        "phone" => $faker->phoneNumber,
        "email" => $faker->email
    ];
});
