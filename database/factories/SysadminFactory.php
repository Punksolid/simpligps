<?php

use Faker\Generator as Faker;

$factory->define(App\Sysadmin::class, function (Faker $faker) {
    return [
        "email" => $faker->email,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    ];
});
