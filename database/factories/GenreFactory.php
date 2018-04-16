<?php

use Faker\Generator as Faker;
use App\Models\Genre;

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->randomElement(Genre::available()),
    ];
});
