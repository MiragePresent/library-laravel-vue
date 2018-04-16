<?php

use Faker\Generator as Faker;
use App\Models\Author;

$factory->define(App\Models\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
