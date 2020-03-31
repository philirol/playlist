<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'band_id' => $faker->numberBetween(1,4),
        'user_id' => $faker->numberBetween(1,10),
        'title' => $faker->citySuffix,        
        'order' => $faker->randomDigitNot(10),
        'list' => 1,
        'comments' => $faker->realText($maxNbChars = 50, $indexSize = 2),      
        'songsubs' => 0
    ];
});