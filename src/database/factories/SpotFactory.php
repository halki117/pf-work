<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Spot;
use App\User;
use Faker\Generator as Faker;

$factory->define(Spot::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'image' => $faker->imageUrl,
        'review' => $faker->text(500),
        'public' => $faker->boolean,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'user_id' => function() {
            return factory(User::class);
        }
    ];
});
