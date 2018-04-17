<?php

namespace App\Repositories;


class GenreRepository
{

    /**
     *  All genres
     * @var array
     */
    protected $genres = [
        'Science fiction',
        'Satire',
        'Drama',
        'Action and Adventure',
        'Romance',
        'Mystery',
        'Horror',
        'Self help',
        'Health',
        'Guide',
        'Travel',
        'Children\'s',
        'Religion, Spirituality & New Age',
        'Science',
        'History',
        'Math',
        'Anthology',
        'Poetry',
        'Encyclopedias',
        'Dictionaries',
        'Comics',
        'Art',
        'Cookbooks',
        'Diaries',
        'Journals',
        'Prayer books',
        'Series',
        'Trilogy',
        'Biographies',
        'Autobiographies',
        'Fantasy',
    ];

    /**
     *  Get all genres
     * @return array
     */
    public function all()
    {
        return $this->genres;
    }

    /**
     *  Get random genre
     * @return string
     */
    public function random()
    {
        return $this->genres[array_rand($this->genres)];
    }

    /**
     *  Count genres
     * @return int
     */
    public function count()
    {
        return count($this->genres);
    }

}