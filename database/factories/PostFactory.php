<?php
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'title' => $faker->title,
        'description' => $faker->text,
        'likes' => $faker->numberBetween($min = 1, $max = 300),
    ];
});
