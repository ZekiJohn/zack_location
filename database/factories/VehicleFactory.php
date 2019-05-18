<?php

use Faker\Generator as Faker;
use App\Vehicle;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [

        'owner_id' => function(){
            return factory('App\User')->create()->id;
        },
        'license_plate' => $faker->numberBetween(10000, 99999),
        'color' => array_random(['red', 'black', 'blue', 'yellow', 'white']),
        'model' => array_random(['Toyota', 'Sino', 'Chevrolet']),
        'no_wheel' => $faker->numberBetween(2, 22),
    ];
});
