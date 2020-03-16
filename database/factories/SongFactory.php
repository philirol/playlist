<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'band_id' => $faker->numberBetween(1,4),
        'user_id' => $faker->numberBetween(1,10),
        'title' => $faker->lastName,
        'url' => $faker->url,      
        'order' => $faker->unique()->randomNumber(2),
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),      
        
    ];
});
