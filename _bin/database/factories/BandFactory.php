<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Band;
use Faker\Generator as Faker;

$factory->define(Band::class, function (Faker $faker) {
    $bandname = $faker->Company();
    return [
        'bandname' => $bandname,
        'slug' => Str::slug($bandname),
        'ville_id' => $faker->numberBetween($min = 1, $max = 36830),
    ];
});
