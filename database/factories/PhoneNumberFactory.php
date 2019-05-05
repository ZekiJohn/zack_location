<?php

use Faker\Generator as Faker;
use App\PhoneNumber;

$factory->define(PhoneNumber::class, function (Faker $faker) {
    return [
        'contact_id' => function(){
            return factory('App\Contact')->create()->id;
        },
        // 'contact_id' => $faker->numberBetween($min = 1, $max = 50),
        'phone_number' => $faker->phoneNumber,
    ];
});
