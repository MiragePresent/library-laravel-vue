<?php

use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Repositories\LanguageRepository;

/** @var \App\Repositories\LanguageRepositoryContract $langRepository */
$langRepository = new LanguageRepository();

$factory->define(Book::class, function (Faker $faker) use ($langRepository) {

    return [
        'author_id' => function () {
            if (!! Author::count()) {
                return Author::inRandomOrder()->first()->id;
            }
            return factory(Author::class)->create()->id;
        },
        'genre_id' => function () {
            if (!! Genre::count()) {
                return Genre::inRandomOrder()->first()->id;
            }
            return factory(Genre::class)->create()->id;
        },
        'isbn' => $faker->unique()->isbn13,
        'title' => $faker->sentence(rand(1, 6)),
        'lang' => $langRepository->random()->code,
    ];
});
