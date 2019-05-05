<?php
use App\Contact;
use Faker\Generator as Faker;
$factory->define(Contact::class, function(Faker $faker){
    return [
        // 'user_id' => function(){
        //     return factory('App\User')->create()->id;
        // },
        'user_id' => factory('App\User')->create()->id,
        // 'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->email,
    ];
});
