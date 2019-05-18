<?php

use Faker\Generator as Faker;
use App\Dog;

$factory->define(Dog::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'age' => $faker->numberBetween($min = 10, $max = 30),
        'weight' => $faker->numberBetween(30, 60),
        'sex' => $faker->randomElement(['male', 'female']),
    ];
});
