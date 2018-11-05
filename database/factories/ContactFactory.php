<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "company" => $faker->company,
        "phone" => $faker->phoneNumber,
        "email" => $faker->email,
        "address" => $faker->address
    ];
});
