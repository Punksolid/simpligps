<?php

use Faker\Generator as Faker;

$factory->define(App\TruckTract::class, function (Faker $faker) {
    return [
        'plate' => $faker->hexColor,
        'model' => $faker->company,
        'internal_number' => (string) $faker->randomNumber(6),
        'brand' => $faker->company,
        'gps' => $faker->shuffleString('tsetarapprobra'),
        'color' => $faker->colorName,
        'carrier_id' => factory(\App\Carrier::class)->create()->id,
        'device_id' => factory(\App\Device::class)->create()->id,
        'operator_id' => factory(\App\Operator::class)->create()->id
    ];
});
