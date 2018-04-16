<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *  Genre model
 *
 * @property int $id
 * @property string $title
 */

class Genre extends Model
{
    protected $fillable = [
        'title',
    ];

    // HELPERS

    /**
     *  Available genres
     * @return array
     */
    public static function available()
    {
        return [
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
    }
}
