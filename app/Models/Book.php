<?php

namespace App\Models;

use App\Repositories\LanguageRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Book model
 *
 * @property int $id
 * @property int $author_id
 * @property int $genre_id
 * @property string $isbn
 * @property string $title
 * @property string $lang
 * @property-read string $language
 * @property-read \App\Models\Author $author
 * @property-read \App\Models\Genre $genre
 *
 * @method static static ordered()  Default ordering
 * @method static static orderedDesc()  Reversed ordering
 * @method static static search(string $q)  Search book
 */

class Book extends Model
{
    protected $fillable = [
        'author_id',
        'genre_id',
        'isbn',
        'title',
        'lang',
    ];

    protected $appends = [
        'language',
    ];

    // RELATIONS

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // SCOPES

    public function scopeOrdered(Builder $query)
    {
        return$query->orderBy('title');
    }

    // ACCESSORS

    public function getLanguageAttribute()
    {
        return (new LanguageRepository())->find($this->lang)->title;
    }
}

