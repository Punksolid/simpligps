<?php

use Faker\Generator as Faker;

$factory->define(App\TruckTract::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'plate' => $faker->hexColor,
        'model' => $faker->company,
        'internal_number' => (string) $faker->randomNumber(6),
        'brand' => $faker->company,
        'color' => $faker->colorName,
        'carrier_id' => factory(\App\Carrier::class)->create()->id,
    ];
});
