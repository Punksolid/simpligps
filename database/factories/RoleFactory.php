<?php

use Faker\Generator as Faker;
use App\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        "name" => $faker->userName,
//        "guard_name" => "api"
        "guard_name" => "web"
    ];
});
